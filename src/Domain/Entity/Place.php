<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность места, где проводится мероприятие.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PlaceRepository")
 */
class Place
{
    /**
     * Идентификатор.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Название места.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Адрес места.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * Получение идентификатора.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Получение имени.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Установка имени.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Получение адреса.
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Установка адреса.
     *
     * @param string $address
     *
     * @return $this
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }
}
