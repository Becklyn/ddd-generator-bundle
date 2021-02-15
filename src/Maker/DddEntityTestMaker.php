<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker;

/**
 * Abstract Maker that provides base functionality for generating Domain-Driven-Design Entity-related test classes.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
abstract class DddEntityTestMaker extends DddEntityMaker
{
    protected function buildNamespace (string $domain, string $userProvidedNamespace, array $variables = []) : string
    {
        return "Tests\\" . parent::buildNamespace($domain, $userProvidedNamespace);
    }
}
