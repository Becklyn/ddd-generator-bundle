<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\Ddd\Identity\Domain\AbstractAggregateId;
use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;

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
            AbstractAggregateId::class => 'becklyn/ddd-core',
        ];
    }
}
