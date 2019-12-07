<?php
declare(strict_types = 1);

namespace Av\Tests\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture as BaseFixture;

/**
 * Абстрактная фикстура
 */
abstract class AbstractFixture extends BaseFixture
{
    /**
     * Создать ссылку.
     *
     * @param object|string $name
     * @param int           $id
     *
     * @return string
     */
    public static function createRefName($name, int $id): string
    {
        return \sprintf('%s__%d', \is_object($name) ? \get_class($name) : $name, $id);
    }

    /**
     * Сохранить ссылку на объект.
     *
     * @param object $object
     * @param int    $id
     */
    protected function saveRef(object $object, int $id): void
    {
        $this->setReference(self::createRefName($object, $id), $object);
    }

    /**
     * Загрузить объект по ссылке.
     *
     * @param string $name
     * @param int    $id
     *
     * @return mixed
     */
    protected function loadRef(string $name, int $id)
    {
        return $this->getReference(self::createRefName($name, $id));
    }
}
