<?php

namespace App\Repository;

use App\Entity\TrainingPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TrainingPlan>
 *
 * @method TrainingPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingPlan[]    findAll()
 * @method TrainingPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingPlan::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TrainingPlan $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(TrainingPlan $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return TrainingPlan[] Returns an array of TrainingPlan objects
    //  */
    public function findAllSortedByDate(): array
    {
        return $this->findBy(array(), array('start_date' => 'ASC'));
    }

    /*
    public function findOneBySomeField($value): ?TrainingPlan
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
