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
 * Event participation entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\ParticipationRepository")
 */
class Participation
{
    // Types of transport
    public const TRANSPORT_CAR = 1;
    public const TRANSPORT_BUS = 2;

    /**
     * Identifier.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Transport type.
     *
     * @ORM\Column(type="integer")
     */
    private int $transportType = self::TRANSPORT_CAR;

    /**
     * Number of members attached.
     *
     * @ORM\Column(type="integer")
     */
    private int $membersCount = 0;

    /**
     * The participant refused?
     *
     * @ORM\Column(type="boolean")
     */
    private bool $refused = false;

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
     * Get transport type.
     *
     * @return int
     */
    public function getTransportType(): int
    {
        return $this->transportType;
    }

    /**
     * Set transport type.
     *
     * @param int $transportType
     *
     * @return $this
     */
    public function setTransportType(int $transportType): self
    {
        $this->transportType = $transportType;

        return $this;
    }

    /**
     * Get the number of members attached.
     *
     * @return int
     */
    public function getMembersCount(): int
    {
        return $this->membersCount;
    }

    /**
     * Set the number of members attached.
     *
     * @param int $membersCount
     *
     * @return $this
     */
    public function setMembersCount(int $membersCount): self
    {
        $this->membersCount = $membersCount;

        return $this;
    }

    /**
     * Is participant refused?
     *
     * @return bool
     */
    public function isRefused(): bool
    {
        return $this->refused;
    }

    /**
     * Setting a flag identifying a refused participant.
     *
     * @param bool $refused
     *
     * @return $this
     */
    public function setRefused(bool $refused = true): self
    {
        $this->refused = $refused;

        return $this;
    }
}
