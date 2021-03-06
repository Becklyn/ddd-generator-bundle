<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Entity;

use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Maker that generates a Domain-Driven-Design  DoctrineEntityRepository class.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeAggregateDoctrineRepository extends DddEntityMaker
{
    protected string $layer = "Infrastructure\\Domain";

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Doctrine implementation of the entities repository";
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
        return "Repository";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            EntityManagerInterface::class => 'doctrine/orm',
            ObjectRepository::class => 'doctrine/persistence',
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
