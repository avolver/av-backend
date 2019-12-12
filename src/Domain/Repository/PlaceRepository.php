<?php
declare(strict_types = 1);

namespace Av\Domain\Repository;

use Av\Domain\Entity\Place;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Репозиторий мест, в которых проводятся мероприятия.
 *
 * @method Place|null find($id, $lockMode = null, $lockVersion = null)
 * @method Place|null findOneBy(array $criteria, array $orderBy = null)
 * @method Place[]    findAll()
 * @method Place[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceRepository extends ServiceEntityRepository
{
    /**
     * Конструктор.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Place::class);
    }
}
