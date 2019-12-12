<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность типа мест, в которых проводятся мероприятия.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PlaceTypeRepository")
 */
class PlaceType
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
     * Название типа.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

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
     * Получение названия типа.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Установка названия типа.
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
}
