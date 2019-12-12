<?php
declare(strict_types = 1);

namespace Av\Domain\Repository;

use Av\Domain\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Репозиторий пациентов.
 *
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    /**
     * Конструктор.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }
}
