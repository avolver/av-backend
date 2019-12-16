<?php
/**
 * The software is called "Auto-Volunteers" and is a volunteer coordination system.
 * Copyright (C) 2019 Vladimir Tkachev
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types = 1);

namespace Av\Common;

use Av\Common\DependencyInjection\Compiler\RemoveUnnecessaryPass;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * Symfony kernel
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

        $loader->load(static function (ContainerBuilder $container) {
            $container->setParameter('container.dumper.inline_class_loader', true);
        });
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new RemoveUnnecessaryPass());
    }
}
