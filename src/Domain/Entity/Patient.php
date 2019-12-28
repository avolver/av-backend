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
 * Patient entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PatientRepository")
 *
 * @method int|null getId()
 *
 * @method string getName()
 * @method Patient setName(string $name)
 *
 * @method int getStatus()
 * @method Patient setStatus(int $status)
 *
 * @method \DateTimeInterface getRegistrationDate()
 * @method Patient setRegistrationDate(\DateTimeInterface $registrationDate)
 *
 * @method Clinic getClinic()
 * @method Patient setClinic(Clinic $clinic)
 *
 * @method \DateTimeInterface|null getBirthday()
 * @method Patient setBirthday(?\DateTimeInterface $birthday)
 *
 * @method int getEventCount()
 * @method Patient setEventCount(int $eventCount)
 *
 * @method int getConsentToPublication()
 * @method Patient setConsentToPublication(int $consentToPublication)
 *
 * @method bool getWheelchairUser()
 * @method Patient setWheelchairUser(bool $wheelchairUser)
 */
class Patient
{
    use RichModelTrait;

    //
    // Patient status
    //

    // Outside the clinic
    public const STATUS_OUT = 0;

    // In clinic
    public const STATUS_IN  = 1;

    //
    // Consent to publish photos
    //
    public const CONSENT_TO_PUB_DONT_KNOW = 0;
    public const CONSENT_TO_PUB_DONT_YES = 1;
    public const CONSENT_TO_PUB_DONT_NO = 2;

    /**
     * Identifier.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Full name.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Status.
     *
     * @ORM\Column(type="integer")
     */
    private int $status = self::STATUS_OUT;

    /**
     * Registration date.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $registrationDate;

    /**
     * Clinic.
     *
     * @ORM\ManyToOne(targetEntity="Av\Domain\Entity\Clinic", inversedBy="patients")
     */
    private Clinic $clinic;

    /**
     * Date of birth.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $birthday = null;

    /**
     * The number of events the patient attended.
     *
     * @ORM\Column(type="integer")
     */
    private int $eventCount = 0;

    /**
     * Consent to publish photos.
     *
     * @ORM\Column(type="integer")
     */
    private int $consentToPublication = self::CONSENT_TO_PUB_DONT_KNOW;

    /**
     * Wheelchair user?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $wheelchairUser = false;
}
