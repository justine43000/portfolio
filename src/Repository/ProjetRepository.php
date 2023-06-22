<?php

namespace App\Repository;

use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projet>
 *
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);
    }

    public function save(Projet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Projet $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function lastThree()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
    public function findAllWithCategories()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.categorie', 'c')
            ->addSelect('c')
            ->orderBy('p.id', 'DESC') // tri par ordre décroissant de la date de création
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Projet[] Returns an array of Projet objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'DESC')
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Projet
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
