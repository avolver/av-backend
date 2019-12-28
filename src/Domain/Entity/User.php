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
use SixDreams\RichModel\Traits\RichModelTrait;

/**
 * User entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\UserRepository")
 *
 * @method int|null getId()
 *
 * @method string getPrimaryEmail()
 * @method User setPrimaryEmail(string $primaryEmail)
 *
 * @method string getScreenName()
 * @method User setScreenName(string $screenName)
 *
 * @method int getRank()
 * @method User setRank(int $rank)
 *
 * @method array getEmails()
 * @method User setEmails(array $emails)
 *
 * @method string|null getPhone()
 * @method User setPhone(?string $phone)
 *
 * @method string getPassword()
 * @method User setPassword(string $password)
 *
 * @method \DateTimeInterface|null getLastLogin()
 * @method User setLastLogin(\DateTimeInterface $lastLogin)
 *
 * @method array getRoles()
 * @method User setRoles(array $roles)
 *
 * @method bool isEnabled()
 * @method bool setEnabled(bool $enabled)
 */
class User
{
    use RichModelTrait;

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
}
