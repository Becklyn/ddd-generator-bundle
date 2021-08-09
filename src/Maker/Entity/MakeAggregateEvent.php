<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\Ddd\Events\Domain\AbstractDomainEvent;
use Becklyn\Ddd\Events\Domain\EventId;
use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;

/**
 * Maker that generates a Domain-Driven-Design EntityEvent.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeAggregateEvent extends DddEntityMaker
{
    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return "Event";
    }

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Event class related to the Entity class";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            EventId::class => 'becklyn/ddd-core',
            AbstractDomainEvent::class => 'becklyn/ddd-core',
        ];
    }
}
