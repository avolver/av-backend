<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность пациента
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PatientRepository")
 */
class Patient
{
    //
    // Статусы пациента
    //

    // За пределами больницы
    public const STATUS_OUT = 0;

    // В больнице
    public const STATUS_IN  = 1;

    //
    // Согласие на публикацию фотографий
    //

    // Не знаю
    public const CONSENT_TO_PUB_DONT_KNOW = 0;

    // Да
    public const CONSENT_TO_PUB_DONT_YES = 1;

    // Нет
    public const CONSENT_TO_PUB_DONT_NO = 2;

    /**
     * Идентификатор.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * ФИО.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Статус.
     *
     * @ORM\Column(type="integer")
     */
    private int $status = self::STATUS_OUT;

    /**
     * Дата регистрации.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $registrationDate;

    /**
     * Больница.
     *
     * @ORM\ManyToOne(targetEntity="Av\Domain\Entity\Clinic", inversedBy="patients")
     */
    private Clinic $clinic;

    /**
     * Дата рождения
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $birthday = null;

    /**
     * Количество мероприятий, которые посетил пациент.
     *
     * @ORM\Column(type="integer")
     */
    private int $eventCount = 0;

    /**
     * Согласие на публикацию фотографий.
     *
     * @ORM\Column(type="integer")
     */
    private int $consentToPublication = self::CONSENT_TO_PUB_DONT_KNOW;

    /**
     * Колясочник?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $wheelchairUser = false;

    /**
     * Получение идентификатора.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Получение ФИО.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Установка ФИО.
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
     * Получение даты и времени регистрации.
     *
     * @return \DateTimeInterface
     */
    public function getRegistrationDate(): \DateTimeInterface
    {
        return $this->registrationDate;
    }

    /**
     * Установка даты и времени регистрации.
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
     * Получение больницы, к которой прикреплён пациент.
     *
     * @return Clinic
     */
    public function getClinic(): Clinic
    {
        return $this->clinic;
    }

    /**
     * Установка больницы, к которой прикреплён пациент.
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
     * Получение даты рождения.
     *
     * @return \DateTimeInterface|null
     */
    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * Установка даты рождения.
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
     * Получение количества мероприятий, в которых учавствовал пациент.
     *
     * @return int
     */
    public function getEventCount(): int
    {
        return $this->eventCount;
    }

    /**
     * Установка количества мероприятий, в которых учавствовал пациент.
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
     * Получение статуса на согласие публикации фотографий.
     *
     * @return int|null
     */
    public function getConsentToPublication(): ?int
    {
        return $this->consentToPublication;
    }

    /**
     * Установка статуса на согласие публикации фотографий.
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
     * Пациент колясочник?
     *
     * @return bool
     */
    public function getWheelchairUser(): bool
    {
        return $this->wheelchairUser;
    }

    /**
     * Установка флага, определяющего пациента как колясочника.
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
