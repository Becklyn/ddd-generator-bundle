<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

/**
 * Maker that generates a Domain-Driven-Design Entity class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
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
            Column::class => 'doctrine/orm',
            GeneratedValue::class => 'doctrine/orm',
        ];
    }
}
