<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Helper;

use Symfony\Component\HttpKernel\KernelInterface;

/**
 * A Helper class that fetches information about the current git user using the command line.
 *
 * @see DddMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 *
 * @internal This class should only be used internally and never be extended. This is for security reasons because this
 *     class uses the possibly dangerous shell_exec to fetch the information from git.
 */
final class GitUserInfoFetcher
{
    private const FETCH_NAME_COMMAND = "git config user.name";
    private const FETCH_EMAIL_COMMAND = "git config user.email";

    /**
     * Fetches the users name from git.
     * If the username can not be fetched it will fallback to "Code Generator".
     *
     * @internal
     */
    public function getUserName () : string
    {
        $username = \shell_exec(self::FETCH_NAME_COMMAND) ?? "Code Generator";
        return \str_replace(\PHP_EOL, "", $username);
    }

    /**
     * Fetches the users email from git.
     * If the email can not be fetched it will fallback to the composer package name.
     * In case the package name can also not be fetched it will simply return the empty string
     *
     * @internal
     */
    public function getUserEmail (KernelInterface $kernel) : string
    {
        $composerFile = $kernel->getProjectDir() . "/composer.json";
        $composerFileContents = \json_decode(\file_get_contents($composerFile), true);

        if (!isset($composerFileContents["name"]))
        {
            return "";
        }

        $packageName = $composerFileContents["name"];

        $email = \shell_exec(self::FETCH_EMAIL_COMMAND) ?? $packageName;
        return \str_replace(\PHP_EOL, "", $email);
    }
}
