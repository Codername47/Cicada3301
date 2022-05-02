<?php

namespace App\Repository;

use App\Entity\AchievedFlag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AchievedFlag>
 *
 * @method AchievedFlag|null find($id, $lockMode = null, $lockVersion = null)
 * @method AchievedFlag|null findOneBy(array $criteria, array $orderBy = null)
 * @method AchievedFlag[]    findAll()
 * @method AchievedFlag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AchievedFlagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AchievedFlag::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(AchievedFlag $entity, bool $flush = true): void
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
    public function remove(AchievedFlag $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return AchievedFlag[] Returns an array of AchievedFlag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AchievedFlag
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
