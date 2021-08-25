<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\MultiClass;

use Becklyn\DddGeneratorBundle\Helper\GitUserInfoFetcher;
use Becklyn\DddGeneratorBundle\Maker\DddEntityMaker;
use Becklyn\DddGeneratorBundle\Maker\MakeDomain;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;

abstract class MultiClassMaker extends DddEntityMaker
{
    public function generate (InputInterface $input, ConsoleStyle $io, Generator $generator) : void
    {
        $domain = $input->getOption(parent::DOMAIN_NAME_OPTION_KEY);

        if (!$this->isDomainConfigured($domain))
        {
            (new MakeDomain($this->kernel, new GitUserInfoFetcher()))->generate($input, $io, $generator);
        }

        foreach ($this->getMakers() as $maker)
        {
            try
            {
                $maker->generate($input, $io, $generator);
            }
            catch (\Exception $e)
            {
                $io->note(
                    \sprintf(
                        "Maker \"%s\" ran into a problem.\n" .
                        "You can use \"%s\" to manually invoke the generation process.\n" .
                        "Details: \n%s",
                        \get_class($maker),
                        $maker->getCommandName(),
                        $e->getMessage()
                    )
                );
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function interact (InputInterface $input, ConsoleStyle $io, Command $command) : void
    {
        parent::interact($input, $io, $command);
        $domainName = $input->getOption("domain-name");

        if (!$this->isDomainConfigured($domainName))
        {
            $language = $io->ask("The language of the domain");
            $command->addOption("language", $language);
            $input->setOption("language", $language);
        }
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [];
    }

    /**
     * Returns a list of Makers that are to be generated
     *
     * @return AbstractMaker[]
     */
    abstract public function getMakers () : array;
}
