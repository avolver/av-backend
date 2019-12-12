<?php
declare(strict_types = 1);

namespace Av\Domain\Repository;

use Av\Domain\Entity\PatientRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Репозиторий запросов пациентов из конкретной больницы на конкретное мероприятие.
 *
 * @method PatientRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientRequest[]    findAll()
 * @method PatientRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRequestRepository extends ServiceEntityRepository
{
    /**
     * Конструктор.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientRequest::class);
    }
}
