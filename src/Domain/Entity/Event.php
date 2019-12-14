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

namespace Av\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность мероприятия.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\EventRepository")
 */
class Event
{
    // Статусы мероприятия:

    // Открытое
    public const STATUS_OPEN = 1;

    // Закрытое
    public const STATUS_CLOSED = 2;

    // Прошедшее
    public const STATUS_PAST = 3;

    /**
     * Идентификатор.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Дата и время начала.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $beginDateTime;

    /**
     * Дата и время окончания.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $endDateTime;

    /**
     * Адрес.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * Название.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Общее количество участников.
     *
     * @ORM\Column(type="integer")
     */
    private int $participantsTotal = 0;

    /**
     * Статус.
     *
     * @ORM\Column(type="integer")
     */
    private int $status;

    /**
     * Описание маршрута.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $routeDescription = null;

    /**
     * Ссылки на фотографии и другие файлы.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $links = null;

    /**
     * Доступно колясочникам?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $wheelchairUser = false;

    /**
     * Необходимы документы.
     *
     * @ORM\Column(type="boolean")
     */
    private bool $needDocuments = false;

    /**
     * Возрастные ограничения.
     *
     * @ORM\Column(type="integer")
     */
    private int $ageRestrictions;

    /**
     * Время отправления транспорта.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $transportStartTime = null;

    /**
     * Время встречи транспорта.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $transportFinishTime = null;

    /**
     * Запросы пациентов.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\PatientRequest", mappedBy="event", orphanRemoval=true)
     */
    private Collection $patientRequests;

    /**
     * Конструктор.
     */
    public function __construct()
    {
        $this->patientRequests = new ArrayCollection();
    }

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
     * Получение даты и времени начала.
     *
     * @return \DateTimeInterface
     */
    public function getBeginDateTime(): \DateTimeInterface
    {
        return $this->beginDateTime;
    }

    /**
     * Установка даты и времени начала.
     *
     * @param \DateTimeInterface $beginDateTime
     *
     * @return $this
     */
    public function setBeginDateTime(\DateTimeInterface $beginDateTime): self
    {
        $this->beginDateTime = $beginDateTime;

        return $this;
    }

    /**
     * Получение даты и времени окончания.
     *
     * @return \DateTimeInterface
     */
    public function getEndDateTime(): \DateTimeInterface
    {
        return $this->endDateTime;
    }

    /**
     * Установка даты и времени окончания.
     *
     * @param \DateTimeInterface $endDateTime
     *
     * @return $this
     */
    public function setEndDateTime(\DateTimeInterface $endDateTime): self
    {
        $this->endDateTime = $endDateTime;

        return $this;
    }

    /**
     * Получение адреса.
     *
     * @return string
     */
    public function getAddress(): string
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
     * Получение общего количества участников.
     *
     * @return int
     */
    public function getParticipantsTotal(): int
    {
        return $this->participantsTotal;
    }

    /**
     * Установка общего количества участников.
     *
     * @param int $participantsTotal
     *
     * @return $this
     */
    public function setParticipantsTotal(int $participantsTotal): self
    {
        $this->participantsTotal = $participantsTotal;

        return $this;
    }

    /**
     * Получение статуса.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Установка статуса.
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Получение описания маршрута.
     *
     * @return string|null
     */
    public function getRouteDescription(): ?string
    {
        return $this->routeDescription;
    }

    /**
     * Установка описания маршрута.
     *
     * @param string|null $routeDescription
     *
     * @return $this
     */
    public function setRouteDescription(?string $routeDescription): self
    {
        $this->routeDescription = $routeDescription;

        return $this;
    }

    /**
     * Получение ссылок на фотографии и другие файлы.
     *
     * @return string|null
     */
    public function getLinks(): ?string
    {
        return $this->links;
    }

    /**
     * Установка ссылок на фотографии и другие файлы.
     *
     * @param string|null $links
     *
     * @return $this
     */
    public function setLinks(?string $links): self
    {
        $this->links = $links;

        return $this;
    }

    /**
     * Получение флага доступности колясочникам.
     *
     * @return bool
     */
    public function getWheelchairUser(): bool
    {
        return $this->wheelchairUser;
    }

    /**
     * Установка флага доступности колясочникам.
     *
     * @param bool $wheelchairUser
     *
     * @return $this
     */
    public function setWheelchairUser(bool $wheelchairUser): self
    {
        $this->wheelchairUser = $wheelchairUser;

        return $this;
    }

    /**
     * Получение флага необходимости документов.
     *
     * @return bool
     */
    public function getNeedDocuments(): bool
    {
        return $this->needDocuments;
    }

    /**
     * Установка флага необходимости документов.
     *
     * @param bool $needDocuments
     *
     * @return $this
     */
    public function setNeedDocuments(bool $needDocuments): self
    {
        $this->needDocuments = $needDocuments;

        return $this;
    }

    /**
     * Получение статуса о возрастных ограничениях.
     *
     * @return int
     */
    public function getAgeRestrictions(): int
    {
        return $this->ageRestrictions;
    }

    /**
     * Установка статуса о возрастных ограничениях.
     *
     * @param int $ageRestrictions
     *
     * @return $this
     */
    public function setAgeRestrictions(int $ageRestrictions): self
    {
        $this->ageRestrictions = $ageRestrictions;

        return $this;
    }

    /**
     * Получение времени отправления транспорта.
     *
     * @return \DateTimeInterface|null
     */
    public function getTransportStartTime(): ?\DateTimeInterface
    {
        return $this->transportStartTime;
    }

    /**
     * Установка времени отправления транспорта.
     *
     * @param \DateTimeInterface|null $transportStartTime
     *
     * @return $this
     */
    public function setTransportStartTime(?\DateTimeInterface $transportStartTime): self
    {
        $this->transportStartTime = $transportStartTime;

        return $this;
    }

    /**
     * Получение времени встречи транспорта.
     *
     * @return \DateTimeInterface|null
     */
    public function getTransportFinishTime(): ?\DateTimeInterface
    {
        return $this->transportFinishTime;
    }

    /**
     * Установка времени встречи транспорта
     *
     * @param \DateTimeInterface|null $transportFinishTime
     *
     * @return $this
     */
    public function setTransportFinishTime(?\DateTimeInterface $transportFinishTime): self
    {
        $this->transportFinishTime = $transportFinishTime;

        return $this;
    }

    /**
     * Получение запросов пациентов в данной клинике
     *
     * @return Collection|PatientRequest[]
     */
    public function getPatientRequests(): Collection
    {
        return $this->patientRequests;
    }

    /**
     * Добавление запросов пациентов.
     *
     * @param PatientRequest $patientRequest
     *
     * @return $this
     */
    public function addPatientRequest(PatientRequest $patientRequest): self
    {
        if (!$this->patientRequests->contains($patientRequest)) {
            $this->patientRequests[] = $patientRequest;
            $patientRequest->setEvent($this);
        }

        return $this;
    }

    /**
     * Удаление запросов пациентов.
     *
     * @param PatientRequest $patientRequest
     *
     * @return $this
     */
    public function removePatientRequest(PatientRequest $patientRequest): self
    {
        if ($this->patientRequests->contains($patientRequest)) {
            $this->patientRequests->removeElement($patientRequest);
            if ($patientRequest->getEvent() === $this) {
                $patientRequest->setEvent(null);
            }
        }

        return $this;
    }
}
