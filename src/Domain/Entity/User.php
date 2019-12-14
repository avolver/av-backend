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
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\UserRepository")
 */
class User
{
    /**
     * Идентификатор.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Email для входа в аккаунт.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $primaryEmail;

    /**
     * Отображаемое имя.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $screenName;

    /**
     * Рейтинг пользователя.
     *
     * @ORM\Column(type="integer")
     */
    private int $rank = 0;

    /**
     * Список дополнительных email адресов.
     *
     * @ORM\Column(type="array")
     */
    private array $emails = [];

    /**
     * Номер телефона.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $phone = null;

    /**
     * Пользователь активен?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $enabled = false;

    /**
     * Хеш пароля.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    /**
     * Дата последнего входа.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $lastLogin = null;

    /**
     * Роли пользователя.
     *
     * @ORM\Column(type="array")
     */
    private array $roles = [];

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
     * Получение email адреса для входа в аккаунт.
     *
     * @return string
     */
    public function getPrimaryEmail(): string
    {
        return $this->primaryEmail;
    }

    /**
     * Установка email для входа в аккаунта.
     *
     * @param string $primaryEmail
     *
     * @return $this
     */
    public function setPrimaryEmail(string $primaryEmail): self
    {
        $this->primaryEmail = $primaryEmail;

        return $this;
    }

    /**
     * Получение отображаемого имени.
     *
     * @return string
     */
    public function getScreenName(): string
    {
        return $this->screenName;
    }

    /**
     * Установка отображаемого имени.
     *
     * @param string $screenName
     *
     * @return $this
     */
    public function setScreenName(string $screenName): self
    {
        $this->screenName = $screenName;

        return $this;
    }

    /**
     * Получение рейтинга пользователя.
     *
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * Установка рейтинга пользователя.
     *
     * @param int $rank
     *
     * @return $this
     */
    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Получение списка дополнительных email-адресов.
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * Установка дополнительные email-адресов.
     *
     * @param array $emails
     *
     * @return $this
     */
    public function setEmails(array $emails): self
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Получение номера телефона.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Установка номера телефона.
     *
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Возвращает флаг активности пользователя.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Установка флага активности пользователя.
     *
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Получение хеша пароля.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Установка хеша пароля.
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Получение даты и времени последнего входа.
     *
     * @return \DateTimeInterface|null
     */
    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    /**
     * Установка даты и времени последнего входа.
     *
     * @param \DateTimeInterface $lastLogin
     *
     * @return $this
     */
    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Получение списка ролей.
     *
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Установка списка ролей.
     *
     * @param array $roles
     *
     * @return $this
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
}
