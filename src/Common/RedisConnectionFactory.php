<?php
declare(strict_types = 1);

namespace Av\Common;

use Predis\Connection\PhpiredisSocketConnection;
use Predis\Connection\PhpiredisStreamConnection;
use Snc\RedisBundle\Client\Predis\Connection\ConnectionFactory as BaseConnectionFactory;

/**
 * Фабрика redis-соединений, указывающее работать через расширение phpiredis
 * Реализовано для большей производительности
 */
final class RedisConnectionFactory extends BaseConnectionFactory
{
    /**
     * Конструктор.
     */
    public function __construct()
    {
        $this->schemes = [
            'tcp'  => PhpiredisStreamConnection::class,
            'unix' => PhpiredisSocketConnection::class
        ];
    }
}
