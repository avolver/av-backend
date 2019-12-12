<?php
declare(strict_types = 1);

namespace Av\Domain\Repository;

use Av\Domain\Entity\PlaceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Репозиторий типов мест, в которых проводятся мероприятия.
 *
 * @method PlaceType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceType[]    findAll()
 * @method PlaceType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceTypeRepository extends ServiceEntityRepository
{
    /**
     * Конструктор.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceType::class);
    }
}
