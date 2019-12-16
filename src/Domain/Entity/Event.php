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
 * Event entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\EventRepository")
 */
class Event
{
    // Event statuses:
    public const STATUS_OPEN   = 1;
    public const STATUS_CLOSED = 2;
    public const STATUS_PAST   = 3;

    /**
     * Identifier.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Start date and time.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $beginDateTime;

    /**
     * End date and time.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $endDateTime;

    /**
     * Address.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * Name.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Total number of participants.
     *
     * @ORM\Column(type="integer")
     */
    private int $participantsTotal = 0;

    /**
     * Status.
     *
     * @ORM\Column(type="integer")
     */
    private int $status;

    /**
     * Route description.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $routeDescription = null;

    /**
     * Links to photos and other files.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $links = null;

    /**
     * Wheelchair accessible?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $wheelchairUser = false;

    /**
     * Documents required.
     *
     * @ORM\Column(type="boolean")
     */
    private bool $needDocuments = false;

    /**
     * Age restrictions.
     *
     * @ORM\Column(type="integer")
     */
    private int $ageRestrictions;

    /**
     * Departure time.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $transportStartTime = null;

    /**
     * Transport meeting time.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $transportFinishTime = null;

    /**
     * Patient requests.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\PatientRequest", mappedBy="event", orphanRemoval=true)
     */
    private Collection $patientRequests;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->patientRequests = new ArrayCollection();
    }

    /**
     * Getting ID.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getting start date and time.
     *
     * @return \DateTimeInterface
     */
    public function getBeginDateTime(): \DateTimeInterface
    {
        return $this->beginDateTime;
    }

    /**
     * Set start date and time.
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
     * Getting end date and time.
     *
     * @return \DateTimeInterface
     */
    public function getEndDateTime(): \DateTimeInterface
    {
        return $this->endDateTime;
    }

    /**
     * Set end date and time.
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
     * Getting address.
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set address.
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
     * Getting the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Name setting.
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
     * Getting the total number of participants.
     *
     * @return int
     */
    public function getParticipantsTotal(): int
    {
        return $this->participantsTotal;
    }

    /**
     * Setting the total number of participants.
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
     * Getting status.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Setting status.
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
     * Getting route description.
     *
     * @return string|null
     */
    public function getRouteDescription(): ?string
    {
        return $this->routeDescription;
    }

    /**
     * Setting a route description.
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
     * Getting links to photos and other files.
     *
     * @return string|null
     */
    public function getLinks(): ?string
    {
        return $this->links;
    }

    /**
     * Setting links to photos and other files.
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
     * Getting the wheelchair access flag.
     *
     * @return bool
     */
    public function getWheelchairUser(): bool
    {
        return $this->wheelchairUser;
    }

    /**
     * Setting the wheelchair access flag.
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
     * Getting the flag of the need for documents.
     *
     * @return bool
     */
    public function getNeedDocuments(): bool
    {
        return $this->needDocuments;
    }

    /**
     * Setting the flag of the need for documents.
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
     * Getting age restrictions status.
     *
     * @return int
     */
    public function getAgeRestrictions(): int
    {
        return $this->ageRestrictions;
    }

    /**
     * Setting age restrictions status.
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
     * Getting the time of departure of transport.
     *
     * @return \DateTimeInterface|null
     */
    public function getTransportStartTime(): ?\DateTimeInterface
    {
        return $this->transportStartTime;
    }

    /**
     * Setting the time of departure of transport.
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
     * Getting transport meeting times.
     *
     * @return \DateTimeInterface|null
     */
    public function getTransportFinishTime(): ?\DateTimeInterface
    {
        return $this->transportFinishTime;
    }

    /**
     * Setting transport meeting time
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
     * Getting patient requests in this clinic.
     *
     * @return Collection|PatientRequest[]
     */
    public function getPatientRequests(): Collection
    {
        return $this->patientRequests;
    }

    /**
     * Adding patient requests.
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
     * Removing patient requests.
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
