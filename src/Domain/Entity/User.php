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
 * User entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\UserRepository")
 */
class User
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
     * Email to login.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $primaryEmail;

    /**
     * Display name.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $screenName;

    /**
     * User rating.
     *
     * @ORM\Column(type="integer")
     */
    private int $rank = 0;

    /**
     * List of additional email addresses.
     *
     * @ORM\Column(type="array")
     */
    private array $emails = [];

    /**
     * Phone number.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $phone = null;

    /**
     * User is active?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $enabled = false;

    /**
     * Password hash.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    /**
     * Last login date.
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $lastLogin = null;

    /**
     * User roles.
     *
     * @ORM\Column(type="array")
     */
    private array $roles = [];

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
     * Get an email primary address.
     *
     * @return string
     */
    public function getPrimaryEmail(): string
    {
        return $this->primaryEmail;
    }

    /**
     * Set an primary email address.
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
     * Get display name.
     *
     * @return string
     */
    public function getScreenName(): string
    {
        return $this->screenName;
    }

    /**
     * Set display name.
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
     * Get a user rating.
     *
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * Set user rating.
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
     * Get a list of additional email addresses.
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * Set additional email addresses.
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
     * Get phone number.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set phone number.
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
     * Returns user activity flag.
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * Set user activity flag.
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
     * Get password hash.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password hash.
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
     * Get the date and time of the last login.
     *
     * @return \DateTimeInterface|null
     */
    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    /**
     * Set date and time of last login.
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
     * Get a role list.
     *
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Set role list.
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
