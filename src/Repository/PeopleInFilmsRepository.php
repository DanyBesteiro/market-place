<?php

namespace App\Repository;

use App\Entity\PeopleInFilms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PeopleInFilms>
 *
 * @method PeopleInFilms|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeopleInFilms|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeopleInFilms[]    findAll()
 * @method PeopleInFilms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeopleInFilmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeopleInFilms::class);
    }

    public function add(PeopleInFilms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PeopleInFilms $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PeopleInFilms[] Returns an array of PeopleInFilms objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PeopleInFilms
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
