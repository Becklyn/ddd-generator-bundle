<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\MultiClass;

use C201\DddGeneratorBundle\Helper\GitUserInfoFetcher;
use C201\DddGeneratorBundle\Maker\DddEntityMaker;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntity;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityDoctrineRepository;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityDoctrineRepositoryTest;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityEvent;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityGeneratedEvent;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityId;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityNotFoundException;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityRepository;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityTest;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityTestTrait;

/**
 * Maker that generates every aggregate root relates files.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 1.0.0 Initial Implementation
 */
class MakeAggregateRoot extends MultiClassMaker
{
    /**
     * @inheritDoc
     */
    public static function getCommandName () : string
    {
        return "make:aggregate-root";
    }

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Entity class and every related class that belongs to the Domain.";
    }

    /**
     * @inheritDoc
     */
    public function getMakers () : array
    {
        $gitUserFetcher = new GitUserInfoFetcher();
        return [
            new MakeEntityId($this->kernel, $gitUserFetcher),
            new MakeEntityEvent($this->kernel, $gitUserFetcher),
            new MakeEntityGeneratedEvent($this->kernel, $gitUserFetcher),
            new MakeEntityRepository($this->kernel, $gitUserFetcher),
            new MakeEntityNotFoundException($this->kernel, $gitUserFetcher),
            new MakeEntity($this->kernel, $gitUserFetcher),
            new MakeEntityTestTrait($this->kernel, $gitUserFetcher),
            new MakeEntityTest($this->kernel, $gitUserFetcher),
            new MakeEntityDoctrineRepository($this->kernel, $gitUserFetcher),
            new MakeEntityDoctrineRepositoryTest($this->kernel, $gitUserFetcher),
        ];
    }
}
