<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Helper;


final class KeyGenerator
{
    /**
     * Generates a key for the given class name.
     */
    public static function generateKey (string $className, ?string $suffix = null) : string
    {
        $lastSlash = \mb_strrpos($className, '\\');

        // transform class to local class name
        if (false !== $lastSlash)
        {
            $className = \mb_substr($className, $lastSlash + 1);
        }

        // if suffix is given
        if (null !== $suffix)
        {
            if (0 !== \preg_match('~^(?<name>.*?)' . \preg_quote($suffix, '~') . '$~', $className, $matches))
            {
                return self::dashify($matches["name"], $className);
            }

            throw new \Exception(\sprintf(
                "Can't automatically generate key for class name '%s'. It has to end in '%s'.",
                $className,
                $suffix
            ));
        }

        return self::dashify($className, $className);
    }


    /**
     * Dashifies the text.
     *
     * See tests for examples.
     */
    private static function dashify (string $text, string $className) : string
    {
        $text = \preg_replace(
            [
                '/([A-Z]+)([A-Z][a-z])/',
                '/([a-z\\d])([A-Z])/',
            ],
            [
                '\\1-\\2',
                '\\1-\\2',
            ],
            $text
        );

        $text = \preg_replace('~--+~', '-', \trim($text, '-'));
        $text = \mb_strtolower($text);

        if ("" === $text)
        {
            throw new \Exception(\sprintf(
                "Can't automatically generate key for class name '%s'. It generates to an empty string.",
                $className
            ));
        }

        return $text;
    }


    /**
     *
     */
    public static function isValid (string $key) : bool
    {
        return 0 !== \preg_match('~^([a-z0-9]+[-_])*[a-z0-9]+$~', $key);
    }
}
