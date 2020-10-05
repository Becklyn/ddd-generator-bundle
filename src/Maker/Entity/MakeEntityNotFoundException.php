<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Entity;

use C201\DddGeneratorBundle\Exception\NoSuchDomainException;
use C201\DddGeneratorBundle\Maker\DddEntityMaker;

/**
 * Maker that generates a Domain-Driven-Design EntityNotFoundException class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 1.0.0 Initial Implementation
 */
class MakeEntityNotFoundException extends DddEntityMaker
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
