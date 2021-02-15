<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Entity;

use C201\Ddd\Events\Domain\EventId;
use C201\DddGeneratorBundle\Exception\NoSuchDomainException;
use C201\DddGeneratorBundle\Maker\DddEntityMaker;

/**
 * Maker that generates a Domain-Driven-Design EntityGeneratedEvent class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeEntityCreatedEvent extends DddEntityMaker
{
    /**
     * @inheritDoc
     *
     * @throws NoSuchDomainException
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        $i18n = $this->internationalize($variables["domain"]);
        return $i18n["created"];
    }

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a GeneratedEvent for a related Entity class";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            EventId::class => '201created/ddd',
        ];
    }
}
