<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность запроса пациентов из конкретной больницы на конкретное мероприятие.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PatientRequestRepository")
 */
class PatientRequest
{
    /**
     * Идентификатор запроса.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Больница.
     *
     * @ORM\ManyToOne(targetEntity="Av\Domain\Entity\Clinic", inversedBy="patientRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private Clinic $clinic;

    /**
     * Мероприятие.
     *
     * @ORM\ManyToOne(targetEntity="Av\Domain\Entity\Event", inversedBy="patientRequests")
     * @ORM\JoinColumn(nullable=false)
     */
    private Event $event;

    /**
     * Лимит квоты
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $quotaLimit = null;

    /**
     * Количество посетителей.
     *
     * @ORM\Column(type="integer")
     */
    private int $visitorsCount = 0;

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
     * Получение больницы, в которую делается запрос.
     *
     * @return Clinic
     */
    public function getClinic(): Clinic
    {
        return $this->clinic;
    }

    /**
     * Установка больницы, в которую делается запрос.
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
     * Получение мероприятия, на которое делается запрос.
     *
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * Установка мероприятия, на которое делается запрос.
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
     * Получение лимита квоты запроса.
     *
     * @return int|null
     */
    public function getQuotaLimit(): ?int
    {
        return $this->quotaLimit;
    }

    /**
     * Установка лимита квоты.
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
     * Получение количества посетителей в запросе.
     *
     * @return int
     */
    public function getVisitorsCount(): int
    {
        return $this->visitorsCount;
    }

    /**
     * Установка количества посетителей в запросе.
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
