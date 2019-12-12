<?php
declare(strict_types = 1);

namespace Av\Domain\Repository;

use Av\Domain\Entity\Participation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий прикреплений к мероприятям.
 *
 * @method Participation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Participation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Participation[]    findAll()
 * @method Participation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParticipationRepository extends ServiceEntityRepository
{
    /**
     * Конструктор.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participation::class);
    }
}
