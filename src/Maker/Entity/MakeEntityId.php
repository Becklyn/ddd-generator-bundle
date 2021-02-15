<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Entity;

use C201\Ddd\Identity\Domain\AbstractAggregateId;
use C201\DddGeneratorBundle\Maker\DddEntityMaker;

/**
 * Maker that generates a Domain-Driven-Design EntityId.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeEntityId extends DddEntityMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Id class related to a Entity class.";
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return "Id";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            AbstractAggregateId::class => '201created/ddd',
        ];
    }
}
