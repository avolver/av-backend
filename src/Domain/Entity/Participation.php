<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Прикрепление к мероприятию.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\ParticipationRepository")
 */
class Participation
{
    // Типы транспорта
    public const TRANSPORT_CAR = 1;
    public const TRANSPORT_BUS = 2;

    /**
     * Идентификатор прикрепления.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Тип транспорта.
     *
     * @ORM\Column(type="integer")
     */
    private int $transportType = self::TRANSPORT_CAR;

    /**
     * Количество прикреплённых участников.
     *
     * @ORM\Column(type="integer")
     */
    private int $personCount = 0;

    /**
     * Участник отказался?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $refused = false;

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
     * Получение типа транспорта.
     *
     * @return int
     */
    public function getTransportType(): int
    {
        return $this->transportType;
    }

    /**
     * Установка типа транспорта.
     *
     * @param int $transportType
     *
     * @return $this
     */
    public function setTransportType(int $transportType): self
    {
        $this->transportType = $transportType;

        return $this;
    }

    /**
     * Получение количества прикреплённых участников.
     *
     * @return int
     */
    public function getPersonCount(): int
    {
        return $this->personCount;
    }

    /**
     * Установка количества прикреплённых участников.
     *
     * @param int $personCount
     *
     * @return $this
     */
    public function setPersonCount(int $personCount): self
    {
        $this->personCount = $personCount;

        return $this;
    }

    /**
     * Участник отказался?
     *
     * @return bool
     */
    public function isRefused(): bool
    {
        return $this->refused;
    }

    /**
     * Установка флага, определяющего отказавшегося участника.
     *
     * @param bool $refused
     *
     * @return $this
     */
    public function setRefused(bool $refused = true): self
    {
        $this->refused = $refused;

        return $this;
    }
}
