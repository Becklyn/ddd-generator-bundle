<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Entity;

use C201\DddGeneratorBundle\Maker\DddEntityTestMaker;
use PHPUnit\Framework\TestCase;

/**
 * Maker that generates a test for a Domain-Driven-Design Entity class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 * @see DddEntityTestMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeEntityTest extends DddEntityTestMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Test class for a Entity";
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return "Test";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            TestCase::class => 'phpunit/phpunit',
        ];
    }
}
