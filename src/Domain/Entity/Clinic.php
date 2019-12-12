<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность клиники
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\ClinicRepository")
 */
class Clinic
{
    /**
     * Идентификатор
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Адрес
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * Название
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Индикатор карантина
     *
     * @ORM\Column(type="boolean")
     */
    private bool $quarantine;

    /**
     * Дата, до которой клиника на карантине
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private ?\DateTime $quarantineDate = null;

    /**
     * Контактная информация
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $contactInfo = null;

    /**
     * Список пациентов.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\Patient", mappedBy="clinic")
     */
    private Collection $patients;

    /**
     * Запросы пациентов.
     *
     * @ORM\OneToMany(targetEntity="Av\Domain\Entity\PatientRequest", mappedBy="clinic")
     */
    private Collection $patientRequests;

    /**
     * Конструктор клиники.
     */
    public function __construct()
    {
        $this->quarantine      = false;
        $this->patients        = new ArrayCollection();
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
     * Получение адреса клиники.
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Установка адреса клиники.
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
     * Получение названия клиники.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Установка названия клиники.
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
     * Возвращает true, если клиника на карантине.
     *
     * @return bool
     */
    public function inQuarantine(): bool
    {
        return $this->quarantine;
    }

    /**
     * Устанавливает флаг карантина
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
     * Возвращает дату, до которой клиника на карантине
     *
     * @return \DateTimeInterface|null
     */
    public function getQuarantineDate(): ?\DateTimeInterface
    {
        return $this->quarantineDate;
    }

    /**
     * Установка даты карантина, до которой клиника на карантине
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
     * Получение контактной информации клиники
     *
     * @return string|null
     */
    public function getContactInfo(): ?string
    {
        return $this->contactInfo;
    }

    /**
     * Установка контактной информации клиники
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
     * Получение списка пациентов в больнице.
     *
     * @return Collection|Patient[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    /**
     * Добавление пациента в клинику.
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
     * Удаление пациента и клиники.
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
     * Получение запросов пациентов в данной клинике.
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
            $patientRequest->setClinic($this);
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
            if ($patientRequest->getClinic() === $this) {
                $patientRequest->setClinic(null);
            }
        }

        return $this;
    }
}
