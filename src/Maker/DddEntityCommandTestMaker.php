<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker;

abstract class DddEntityCommandTestMaker extends DddEntityCommandMaker
{
    protected function buildNamespace (string $domain, string $userProvidedNamespace, array $variables = []) : string
    {
        return "Tests\\" . parent::buildNamespace($domain, $userProvidedNamespace, $variables);
    }
}
