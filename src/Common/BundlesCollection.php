<?php
declare(strict_types = 1);

namespace Av\Common;

use Av\Common\Traits\PrivateConstructorTrait;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Snc\RedisBundle\SncRedisBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;

/**
 * Набор необходимых бандлов
 */
final class BundlesCollection
{
    use PrivateConstructorTrait;

    private const BUNDLES_GENERIC = [
        FrameworkBundle::class,
        DoctrineBundle::class,
        DoctrineMigrationsBundle::class,
        SncRedisBundle::class,
        MonologBundle::class
    ];

    private const BUNDLES_DEV = [
        DebugBundle::class,
        MakerBundle::class,
        DoctrineFixturesBundle::class
    ];

    /**
     * Получить все классы бандлов.
     *
     * @param string $env
     *
     * @return \Generator
     */
    public static function getBundles(string $env): \Generator
    {
        yield from self::yieldBundles(self::BUNDLES_GENERIC);

        if ('dev' === $env) {
            yield from self::yieldBundles(self::BUNDLES_DEV);
        }
    }

    /**
     * Создаёт объекты из массива с FCQN и йелдит их.
     *
     * @param array $fcqns
     *
     * @return \Generator
     */
    private static function yieldBundles(array $fcqns): \Generator
    {
        foreach ($fcqns as $fcqn) {
            yield new $fcqn();
        }
    }
}
