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
 * Clinic entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\ClinicRepository")
 *
 * @method int|null getId()
 *
 * @method string getAddress()
 * @method Clinic setAddress(string $address)
 *
 * @method string getName()
 * @method Clinic setName(string $name)
 *
 * @method \DateTimeInterface|null getQuarantineDate()
 * @method Clinic setQuarantineDate(?\DateTimeInterface $date)
 *
 * @method string|null getContactInfo()
 * @method Clinic setContactInfo(string $contactInfo)
 *
 * @method Collection|Patient[] getPatients()
 * @method Collection|PatientRequest[] getPatientRequests()
 */
class Clinic
{
    use RichModelTrait;

    /**
     * Identifier.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * Address.
     *
     * @ORM\Column(type="string", length=255)
     */
    protected string $address;

    /**
     * Name.
     *
     * @ORM\Column(type="string", length=255)
     */
    protected string $name;

    /**
     * Quarantine indicator.
     *
     * @ORM\Column(type="boolean")
     */
    protected bool $quarantine;

    /**
     * Date before which the clinic is in quarantine.
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected ?\DateTime $quarantineDate = null;

    /**
     * Contact information.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $contactInfo = null;

    /**
     * Patient list.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\Patient", mappedBy="clinic")
     */
    protected Collection $patients;

    /**
     * Patient requests.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\PatientRequest", mappedBy="clinic")
     */
    protected Collection $patientRequests;

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
