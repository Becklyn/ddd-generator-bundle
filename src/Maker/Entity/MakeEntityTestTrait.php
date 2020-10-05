<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Entity;

use C201\DddGeneratorBundle\Maker\DddEntityTestMaker;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Maker that generates a trait for a test for a Domain-Driven-Design Entity class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 * @see DddEntityTestMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 1.0.0 Initial Implementation
 */
class MakeEntityTestTrait extends DddEntityTestMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a trait class that is used within the EntityTest class";
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return "TestTrait";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            ObjectProphecy::class => 'phpspec/prophecy',
        ];
    }
}
