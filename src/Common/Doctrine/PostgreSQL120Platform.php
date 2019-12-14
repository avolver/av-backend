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

namespace Av\Common\Doctrine;

use Doctrine\DBAL\Platforms\PostgreSQL100Platform;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;

/**
 * Поддержка 12 версии PostgreSQL
 */
class PostgreSQL120Platform extends PostgreSQL100Platform
{
    /**
     * @param Index        $index
     * @param Table|string $table
     *
     * @return string
     */
    public function getCreateIndexSQL(Index $index, $table): string
    {
        if ($table instanceof Table) {
            $table = $table->getQuotedName($this);
        }

        $name      = $index->getQuotedName($this);
        $columns   = $index->getQuotedColumns($this);
        $using     = '';
        $indexType = '';

        if (0 === \count($columns)) {
            throw new \InvalidArgumentException("Incomplete definition. 'columns' required.");
        }

        if ($index->isPrimary()) {
            return $this->getCreatePrimaryKeySQL($index, $table);
        }

        if (\in_array('jsonb', $index->getFlags())) {
            $using = ' USING GIN';
            $indexType = ' jsonb_path_ops';
        }

        if (\in_array('trgm', $index->getFlags())) {
            $using = ' USING GIN';
            $indexType = ' gin_trgm_ops';
        }

        return \sprintf(
            'CREATE %sINDEX %s ON %s%s (%s%s)%s',
            $this->getCreateIndexSQLFlags($index),
            $name,
            $table,
            $using,
            $this->getIndexFieldDeclarationListSQL($columns, $index->getOptions()),
            $indexType,
            $this->getPartialIndexSQL($index)
        );
    }

    /**
     * @param array $fields
     * @param array $options
     *
     * @return string
     */
    public function getIndexFieldDeclarationListSQL($fields, $options = []): string
    {
        $ret = [];

        foreach ($fields as $field => $definition) {
            $string = \is_array($definition) ? $field : $definition;

            if (!isset($options['sort'])) {
                $ret[] = $string;
                continue;
            }

            if (isset($options['sort'][$field]) && \in_array($options['sort'][$field], ['asc', 'desc'])) {
                $string .= ' '.\strtoupper($options['sort'][$field]);
            }

            $ret[] = $string;
        }

        return \implode(', ', $ret);
    }
}
