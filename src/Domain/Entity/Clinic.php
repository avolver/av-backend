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
 * Clinic entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\ClinicRepository")
 */
class Clinic
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
     * Quarantine indicator.
     *
     * @ORM\Column(type="boolean")
     */
    private bool $quarantine;

    /**
     * Date before which the clinic is in quarantine.
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTime $quarantineDate = null;

    /**
     * Contact information.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $contactInfo = null;

    /**
     * Patient list.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\Patient", mappedBy="clinic")
     */
    private Collection $patients;

    /**
     * Patient requests.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\PatientRequest", mappedBy="clinic")
     */
    private Collection $patientRequests;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->quarantine      = false;
        $this->patients        = new ArrayCollection();
        $this->patientRequests = new ArrayCollection();
    }

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
     * Getting clinic address.
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Setting the clinic address.
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
     * Getting the name of the clinic.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setting the name of the clinic.
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
     * Returns true if the clinic is quarantined.
     *
     * @return bool
     */
    public function inQuarantine(): bool
    {
        return $this->quarantine;
    }

    /**
     * Sets the quarantine flag.
     *
     * @param bool $inQuarantine
     *
     * @return $this
     */
    public function setQuarantine(bool $inQuarantine = true): self
    {
        $this->quarantine = $inQuarantine;

        return $this;
    }

    /**
     * Returns the date by which the clinic is in quarantine.
     *
     * @return \DateTimeInterface|null
     */
    public function getQuarantineDate(): ?\DateTimeInterface
    {
        return $this->quarantineDate;
    }

    /**
     * Setting the quarantine date until which the clinic is in quarantine.
     *
     * @param \DateTimeInterface|null $quarantineDate
     *
     * @return $this
     */
    public function setQuarantineDate(?\DateTimeInterface $quarantineDate): self
    {
        $this->quarantineDate = $quarantineDate;

        return $this;
    }

    /**
     * Getting clinic contact information.
     *
     * @return string|null
     */
    public function getContactInfo(): ?string
    {
        return $this->contactInfo;
    }

    /**
     * Setting clinic contact information.
     *
     * @param string|null $contactInfo
     *
     * @return $this
     */
    public function setContactInfo(?string $contactInfo): self
    {
        $this->contactInfo = $contactInfo;

        return $this;
    }

    /**
     * Getting a list of patients in a clinic.
     *
     * @return Collection|Patient[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    /**
     * Adding a patient to the clinic.
     *
     * @param Patient $patient
     *
     * @return $this
     */
    public function addPatient(Patient $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients[] = $patient;
            $patient->setClinic($this);
        }

        return $this;
    }

    /**
     * Removal of patient and clinic.
     *
     * @param Patient $patient
     *
     * @return $this
     */
    public function removePatient(Patient $patient): self
    {
        if ($this->patients->contains($patient)) {
            $this->patients->removeElement($patient);
            if ($patient->getClinic() === $this) {
                $patient->setClinic(null);
            }
        }

        return $this;
    }

    /**
     * Receiving patient requests in this clinic.
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
            $patientRequest->setClinic($this);
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
            if ($patientRequest->getClinic() === $this) {
                $patientRequest->setClinic(null);
            }
        }

        return $this;
    }
}
