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
use SixDreams\RichModel\Traits\RichModelTrait;

/**
 * Entity of requesting patients from a specific clinic for a specific event.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PatientRequestRepository")
 *
 * @method int|null getId()
 *
 * @method Clinic getClinic()
 * @method Clinic setClinic(Clinic $clinic)
 *
 * @method Event getEvent()
 * @method Patient setEvent(Event $event)
 *
 * @method int|null getQuotaLimit()
 * @method PatientRequest setQuotaLimit(?int $quotaLimit)
 *
 * @method int getVisitorsCount()
 * @method PatientRequest setVisitorsCount(int $visitorsCount)
 */
class PatientRequest
{
    use RichModelTrait;

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
}
