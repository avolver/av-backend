<?php
declare(strict_types = 1);

namespace Av\Common\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Удаляем лишнее из контейнера
 */
class RemoveUnnecessaryPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        // Проверять Request не нужно: TrustedProxies, trusted hosts
        $container->removeDefinition('validate_request_listener');

        // Сессий у меня нет
        $container->removeDefinition('session_listener');

        // Все экшны прописаны статически
        $container->removeDefinition('resolve_controller_name_subscriber');
    }
}
