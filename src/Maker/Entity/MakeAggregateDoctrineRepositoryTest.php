<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\DddGeneratorBundle\Maker\DddEntityTestMaker;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Maker that generates a test for a Domain-Driven-Design DoctrineEntityRepository class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 * @see DddEntityTestMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeAggregateDoctrineRepositoryTest extends DddEntityTestMaker
{
    protected string $layer = "Infrastructure\\Domain";

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Test for the Doctrine implementation of the entities repository";
    }

    /**
     * @inheritDoc
     */
    protected function getEntityPrefix (array $variables = []) : string
    {
        return "Doctrine";
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return "RepositoryTest";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            EntityManagerInterface::class => 'doctrine/orm',
            ObjectRepository::class => 'doctrine/persistence',
            ObjectProphecy::class => 'phpspec/prophecy',
            TestCase::class => 'phpunit/phpunit',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function buildNamespace (string $domain, string $userProvidedNamespace, array $variables = []) : string
    {
        $userProvidedNamespace = $this->appendToNamespace($userProvidedNamespace, ["Doctrine"]);
        return parent::buildNamespace($domain, $userProvidedNamespace);
    }
}
