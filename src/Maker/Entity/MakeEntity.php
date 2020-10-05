<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Entity;

use C201\DddGeneratorBundle\Maker\DddEntityMaker;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Gedmo\Mapping\Annotation\Timestampable;

/**
 * Maker that generates a Domain-Driven-Design Entity class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 1.0.0 Initial Implementation
 */
class MakeEntity extends DddEntityMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Entity class.";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            Timestampable::class => 'gedmo/doctrine-extensions',
            Column::class => 'doctrine/orm',
            GeneratedValue::class => 'doctrine/orm',
        ];
    }
}
