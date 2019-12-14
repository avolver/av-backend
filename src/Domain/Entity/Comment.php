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
