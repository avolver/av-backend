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

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity of requesting patients from a specific clinic for a specific event.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PatientRequestRepository")
 */
class PatientRequest
{
    /**
     * Identifier.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Clinic.
     *
     * @ORM\ManyToOne(targetEntity="Av\Domain\Entity\Clinic", inversedBy="patientRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private Clinic $clinic;

    /**
     * Event.
     *
     * @ORM\ManyToOne(targetEntity="Av\Domain\Entity\Event", inversedBy="patientRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private Event $event;

    /**
     * Quota limit.
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quotaLimit = null;

    /**
     * Visitors count.
     *
     * @ORM\Column(type="integer")
     */
    private int $visitorsCount = 0;

    /**
     * Get ID.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getting the clinic to which the request is made.
     *
     * @return Clinic
     */
    public function getClinic(): Clinic
    {
        return $this->clinic;
    }

    /**
     * Setting the clinic to which the request is made.
     *
     * @param Clinic $clinic
     *
     * @return $this
     */
    public function setClinic(Clinic $clinic): self
    {
        $this->clinic = $clinic;

        return $this;
    }

    /**
     * Get the requested event.
     *
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * Set the requested event.
     *
     * @param Event $event
     *
     * @return $this
     */
    public function setEvent(Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Getting request quota limit.
     *
     * @return int|null
     */
    public function getQuotaLimit(): ?int
    {
        return $this->quotaLimit;
    }

    /**
     * Setting request quota limit.
     *
     * @param int|null $quotaLimit
     *
     * @return $this
     */
    public function setQuotaLimit(?int $quotaLimit): self
    {
        $this->quotaLimit = $quotaLimit;

        return $this;
    }

    /**
     * Getting the number of visitors in a request.
     *
     * @return int
     */
    public function getVisitorsCount(): int
    {
        return $this->visitorsCount;
    }

    /**
     * Setting the number of visitors in a request.
     *
     * @param int $visitorsCount
     *
     * @return $this
     */
    public function setVisitorsCount(int $visitorsCount): self
    {
        $this->visitorsCount = $visitorsCount;

        return $this;
    }
}
