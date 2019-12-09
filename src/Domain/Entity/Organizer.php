<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность организатора мероприятия.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\OrganizerRepository")
 */
class Organizer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Отображаемое имя организатора.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Контакты организатора.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $contacts;

    /**
     * Получение ID.
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
     * @return string
     */
    public function getName(): string
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
     * Получение контактов.
     *
     * @return string
     */
    public function getContacts(): string
    {
        return $this->contacts;
    }

    /**
     * Установка контактов.
     *
     * @param string $contacts
     *
     * @return $this
     */
    public function setContacts(string $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }
}
