<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\DddGeneratorBundle\Exception\NoSuchDomainException;
use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;

/**
 * Maker that generates a Domain-Driven-Design EntityNotFoundException class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeAggregateNotFoundException extends DddEntityMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a EntityNotFoundException class for a related Entitiy class";
    }

    /**
     * @inheritDoc
     *
     * @throws NoSuchDomainException
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        $i18n = $this->internationalize($variables["domain"]);
        return $i18n["not_found"] . "Exception";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [];
    }
}
