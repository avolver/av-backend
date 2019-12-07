<?php
declare(strict_types = 1);

namespace Av\Tests\Fixture;

use Av\Domain\Entity\Clinic;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

/**
 * Фикстура клиник.
 */
final class ClinicFixture extends AbstractFixture
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('ru_RU');

        // Создаём больницы
        $baseClinic = new Clinic();
        for ($count = 1; $count <= 5; $count++) {
            $clinic = (clone $baseClinic)
                ->setName('Больница №' . $count)
                ->setAddress($faker->address);

            $this->saveRef($this, $count);
            $manager->persist($clinic);
        }

        $manager->flush();
    }
}
