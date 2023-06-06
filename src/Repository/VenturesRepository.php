<?php

namespace App\Repository;

use App\Entity\Ventures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ventures>
 *
 * @method Ventures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ventures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ventures[]    findAll()
 * @method Ventures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VenturesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ventures::class);
    }

    public function add(Ventures $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ventures $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Ventures[] Returns an array of Ventures objects
     */
    
    public function search($sector,$country): array
    {
        $query = $this->createQueryBuilder('v');
            if(!empty($sector)){
                $query->andwhere('v.sector = :q')
                ->setParameter('q',$sector);
            }
            if(!empty($country)){
                $query->andwhere('v.country = :p')
                ->setParameter('p',$country);
              }
        $query->orderBy('v.id', 'DESC');
        dump($query);
        return $query->getQuery()->getResult();
        
    }

    public function findOneBySomeField($sector,$country): array
    {
         $query =$this->createQueryBuilder('v');
            if(!empty($country) && $country !="All" ){
                $query->andWhere('v.country = :val')
                ->setParameter('val', $country);
            }
            if(!empty($sector) && $sector !="All"){
                $query->andWhere('v.sector = :sec')
                ->setParameter('sec', $sector);
            }
            $query->andWhere('v.status = :s')
            ->setParameter('s', 1);
            return $query->getQuery()
            ->getResult()
        ;
    }
    
    public function findcountry(): array
    {
        return $this->createQueryBuilder('v')
            ->select('v.country')->distinct()  
            ->orderBy('v.country', 'ASC')		
			->andWhere('v.status = :s')
            ->setParameter('s', 1)		
            ->getQuery()
            ->getResult()
        ;
    }

    public function findsectors(): array
    {
        return $this->createQueryBuilder('v')
            ->select('v.sector')->distinct() 
			->andWhere('v.status = :s')
            ->setParameter('s', 1)		
            ->getQuery()
            ->getResult()
        ;
    }
}
