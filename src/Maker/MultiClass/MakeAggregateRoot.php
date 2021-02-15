<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\MultiClass;

use C201\DddGeneratorBundle\Helper\GitUserInfoFetcher;
use C201\DddGeneratorBundle\Maker\DddEntityMaker;
use C201\DddGeneratorBundle\Maker\Entity\MakeAggregateDoctrineRepository;
use C201\DddGeneratorBundle\Maker\Entity\MakeAggregateDoctrineRepositoryTest;
use C201\DddGeneratorBundle\Maker\Entity\MakeAggregateEvent;
use C201\DddGeneratorBundle\Maker\Entity\MakeAggregateNotFoundException;
use C201\DddGeneratorBundle\Maker\Entity\MakeAggregateRepository;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntity;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityCreatedEvent;
use C201\DddGeneratorBundle\Maker\Entity\MakeEntityId;
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
 * @since 2021-01-27 Initial Implementation
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
            new MakeAggregateEvent($this->kernel, $gitUserFetcher),
            new MakeEntityCreatedEvent($this->kernel, $gitUserFetcher),
            new MakeAggregateRepository($this->kernel, $gitUserFetcher),
            new MakeAggregateNotFoundException($this->kernel, $gitUserFetcher),
            new MakeEntity($this->kernel, $gitUserFetcher),
            new MakeEntityTestTrait($this->kernel, $gitUserFetcher),
            new MakeEntityTest($this->kernel, $gitUserFetcher),
            new MakeAggregateDoctrineRepository($this->kernel, $gitUserFetcher),
            new MakeAggregateDoctrineRepositoryTest($this->kernel, $gitUserFetcher),
        ];
    }
}
