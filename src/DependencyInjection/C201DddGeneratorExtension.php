<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class C201DddGeneratorExtension extends Extension
{
    public function load (array $configs, ContainerBuilder $container) : void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . "/../Resources/config"));
        $loader->load("services.yaml");
    }
}
