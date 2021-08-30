<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Helper;

use Becklyn\DddGeneratorBundle\Exception\ComposerProjectNameNotReadableException;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * A Helper class that fetches information about the current git user using the command line.
 *
 * @see DddMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 *
 * @internal This class should only be used internally and never be extended. This is for security reasons because this
 *     class uses the possibly dangerous shell_exec to fetch the information from git.
 */
final class GitUserInfoFetcher
{
    private const FETCH_NAME_COMMAND = ["git", "config", "user.name"];
    private const FETCH_EMAIL_COMMAND = ["git", "config", "user.email"];

    /**
     * Fetches the users name from git.
     * If the username can not be fetched it will fallback to "Code Generator".
     *
     * @internal
     */
    public function getUserName () : string
    {
        $process = new Process(self::FETCH_NAME_COMMAND);

        try {
            $process->mustRun();
            $process->wait();

            $gitUserName = $process->getOutput();
            return \str_replace("\n", "", $gitUserName);
        } catch (ProcessFailedException) {
            return "Code Generator";
        }
    }

    /**
     * Fetches the users email from git.
     * If the email can not be fetched it will fallback to the composer package name.
     * In case the package name can also not be fetched it will output an error message and terminate
     *
     * @internal
     */
    public function getUserEmail (KernelInterface $kernel, ConsoleStyle $io) : string
    {
        $composerFile = $kernel->getProjectDir() . "/composer.json";
        $process = new Process(self::FETCH_EMAIL_COMMAND);
        try
        {
            $process->mustRun();
            $process->wait();
            $email = $process->getOutput();
            return \str_replace("\n", "", $email);
        }
        catch (ProcessFailedException)
        {
            try
            {
                $composerFileContents = \json_decode(
                    \file_get_contents($composerFile),
                    true,
                    521,
                    \JSON_THROW_ON_ERROR
                );
                if (!isset($composerFileContents["name"]))
                {
                    throw new ComposerProjectNameNotReadableException();
                }
                return $composerFileContents["name"];
            }
            catch (\JsonException | ComposerProjectNameNotReadableException) {
                $io->error(["Cannot read \"name\" of project from composer.json.", "Terminating..."]);
                die(1);
            }
        }
    }
}
