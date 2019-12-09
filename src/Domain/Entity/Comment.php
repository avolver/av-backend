<?php
declare(strict_types = 1);

namespace Av\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Сущность комментария
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\CommentRepository")
 */
class Comment
{
    // Приоритеты комментария.
    public const PRIORITY_LOW    = 1;
    public const PRIORITY_NORMAL = 2;
    public const PRIORITY_HIGH   = 3;

    /**
     * Идентификатор.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Дата и время.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $datetime;

    /**
     * Текст.
     *
     * @ORM\Column(type="text")
     */
    private string $text;

    /**
     * Приоритет.
     *
     * @ORM\Column(type="integer")
     */
    private int $priority;

    /**
     * Конструктор.
     */
    public function __construct()
    {
        $this->priority = self::PRIORITY_NORMAL;
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
     * Получение даты и времени комментария.
     *
     * @return \DateTimeInterface
     */
    public function getDatetime(): \DateTimeInterface
    {
        return $this->datetime;
    }

    /**
     * Установка даты и времени комментария.
     *
     * @param \DateTimeInterface $datetime
     *
     * @return $this
     */
    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Получение текста комментария.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Установка текста комментария.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Получение приоритета комментария.
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Установка приоритета комментария.
     *
     * @param int $priority
     *
     * @return $this
     */
    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }
}
