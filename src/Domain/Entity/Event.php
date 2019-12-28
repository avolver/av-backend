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
use SixDreams\RichModel\Traits\RichModelTrait;

/**
 * Event entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\EventRepository")
 *
 * @method int|null getId()
 *
 * @method \DateTimeInterface getBeginDateTime()
 * @method Event setBeginDateTime(\DateTimeInterface $dateTime)
 *
 * @method \DateTimeInterface getEndDateTime()
 * @method Event setEndDateTime(\DateTimeInterface $dateTime)
 *
 * @method string getAddress()
 * @method Event setAddress(string $address)
 *
 * @method string getName()
 * @method Event setName(string $name)
 *
 * @method int getParticipantsTotal()
 * @method int setParticipantsTotal(int $total)
 *
 * @method int getStatus()
 * @method Event setStatus(int $status)
 *
 * @method string|null getRouteDescription()
 * @method Event setRouteDescription(?string $description)
 *
 * @method string|null getLinks()
 * @method Event setLinks(?string $links)
 *
 * @method bool getWheelchairUser()
 * @method Event setWheelchairUser(bool $wheelchairUser)
 *
 * @method bool getNeedDocuments()
 * @method Event setNeedDocuments(bool $needDocuments)
 *
 * @method int getAgeRestrictions()
 * @method Event setAgeRestrictions(int $ageRestrictions)
 *
 * @method \DateTimeInterface|null getTransportStartTime()
 * @method Event setTransportStartTime(?\DateTimeInterface $time)
 *
 * @method \DateTimeInterface|null getTransportFinishTime()
 * @method Event setTransportFinishTime(?\DateTimeInterface $time)
 *
 * @method Collection|PatientRequest[] getPatientRequests()
 */
class Event
{
    use RichModelTrait;

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
