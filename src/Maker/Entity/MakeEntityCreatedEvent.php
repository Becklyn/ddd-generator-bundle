<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\Ddd\Events\Domain\EventId;
use Becklyn\DddGeneratorBundle\Exception\NoSuchDomainException;
use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;

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
            EventId::class => 'becklyn/ddd-core',
        ];
    }
}
