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
 * Event venue entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\PlaceRepository")
 *
 * @method int|null getId()
 *
 * @method string getName()
 * @method Place setName(string $name)
 *
 * @method string|null getAddress()
 * @method Place setAddress(string $address)
 */
class Place
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
     * Place name.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * Place address.
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $address;
}
