<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность интереса пациентов.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\InterestRepository")
 */
class Interest
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
     * Название.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Интерес активен?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $active = false;

    /**
     * Конструктор.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

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
     * Получение названия.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Установка названия.
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
     * Интерес активен?
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Установка флага активности.
     *
     * @param bool $active
     *
     * @return $this
     */
    public function setActive(bool $active = true): self
    {
        $this->active = $active;

        return $this;
    }
}
