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
 * Comment entity.
 *
 * @ORM\Entity(repositoryClass="Av\Domain\Repository\CommentRepository")
 *
 * @method int|null getId()
 *
 * @method \DateTimeInterface getDatetime()
 * @method Comment setDatetime(\DateTimeInterface $dateTime)
 *
 * @method string getText()
 * @method Comment setText(string $text)
 *
 * @method int getPriority()
 * @method Comment setPriority(int $priority)
 */
class Comment
{
    use RichModelTrait;

    // Comment priorities.
    public const PRIORITY_LOW    = 1;
    public const PRIORITY_NORMAL = 2;
    public const PRIORITY_HIGH   = 3;

    /**
     * Identifier.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * Date and time.
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $datetime;

    /**
     * Text.
     *
     * @ORM\Column(type="text")
     */
    private string $text;

    /**
     * Priority.
     *
     * @ORM\Column(type="integer")
     */
    private int $priority;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->priority = self::PRIORITY_NORMAL;
    }
}
