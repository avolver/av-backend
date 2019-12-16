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
 * Patient entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PatientRepository")
 */
class Patient
{
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
     * Get full name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set full name.
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
     * Get status.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Set status.
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
     * Getting the date and time of registration.
     *
     * @return \DateTimeInterface
     */
    public function getRegistrationDate(): \DateTimeInterface
    {
        return $this->registrationDate;
    }

    /**
     * Setting the date and time of registration.
     *
     * @param \DateTimeInterface $registrationDate
     *
     * @return $this
     */
    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Getting the hospital to which the patient is attached.
     *
     * @return Clinic
     */
    public function getClinic(): Clinic
    {
        return $this->clinic;
    }

    /**
     * Setting the hospital to which the patient is attached.
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
     * Getting the date of birth.
     *
     * @return \DateTimeInterface|null
     */
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * Setting the date of birth.
     *
     * @param \DateTimeInterface|null $birthday
     *
     * @return $this
     */
    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Getting the number of events in which the patient participated.
     *
     * @return int
     */
    public function getEventCount(): int
    {
        return $this->eventCount;
    }

    /**
     * Setting the number of events in which the patient participated.
     *
     * @param int $eventCount
     *
     * @return $this
     */
    public function setEventCount(int $eventCount): self
    {
        $this->eventCount = $eventCount;

        return $this;
    }

    /**
     * Get the status of consent to publish photos.
     *
     * @return int|null
     */
    public function getConsentToPublication(): ?int
    {
        return $this->consentToPublication;
    }

    /**
     * Set the status of consent to publish photos.
     *
     * @param int $consentToPublication
     *
     * @return $this
     */
    public function setConsentToPublication(int $consentToPublication): self
    {
        $this->consentToPublication = $consentToPublication;

        return $this;
    }

    /**
     * Patient is wheelchair user?
     *
     * @return bool
     */
    public function getWheelchairUser(): bool
    {
        return $this->wheelchairUser;
    }

    /**
     * Setting a flag that identifies the patient as a wheelchair user.
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
}
