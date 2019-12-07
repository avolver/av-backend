<?php
declare(strict_types = 1);

namespace Av\Common;

use Av\Common\DependencyInjection\Compiler\RemoveUnnecessaryPass;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Symfony ядро
 */
class Kernel extends BaseKernel
{
    /**
     * @inheritDoc
     */
    public function registerBundles()
    {
        yield from BundlesCollection::getBundles($this->environment);
    }

    /**
     * @inheritDoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $confDir = $this->getProjectDir() . '/cfg';
        $loader->load(\sprintf('%s/config_%s.yml', $confDir, $this->environment));
        $loader->load(\sprintf('%s/services.yml', $confDir));
    }

    /**
     * @inheritdoc
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->setParameter('container.dumper.inline_class_loader', true);
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RemoveUnnecessaryPass());
    }
}
