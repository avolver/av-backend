<?php
declare(strict_types = 1);

namespace Av\Action;

use Symfony\Component\HttpFoundation\Response;

/**
 * Корневая страница сервиса, отображающая заглушку
 */
class IndexAction
{
    /**
     * Возврат ответа-пустышки
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        return new Response('nop');
    }
}
