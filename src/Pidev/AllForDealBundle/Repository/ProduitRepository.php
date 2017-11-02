<?php

namespace Pidev\AllForDealBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProduitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduitRepository extends EntityRepository {

    public function findArray($array) {
        $qb=$this->createQueryBuilder('p')
                ->select('p')
                ->where('p.id IN (:array)')
                ->setParameter('array', $array);
        return $qb->getQuery()->getResult();
    }
 public function byCategorie($idSousCategorie)
    {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.idSousCategorie = :idSousCategorie')
                ->orderBy('u.id')
                ->setParameter('idSousCategorie', $idSousCategorie);
        return $qb->getQuery()->getResult();
    }

       public function countProduit($idSousCategorie)
           {
        $qb = $this->createQueryBuilder('u')
                ->select('count(u.id)')
                ->where('u.idSousCategorie = :idSousCategorie')
                ->setParameter('idSousCategorie', $idSousCategorie);
        return $qb->getQuery()->getSingleScalarResult();
    }
     public function countallProduit()
           {
        $qb = $this->createQueryBuilder('u')
                ->select('count(u.id)')
                ;
        return $qb->getQuery()->getSingleScalarResult();
    }
      public function findLike($filter) {
        $query = $this
                ->getEntityManager()
                ->createQuery("SELECT m FROM PidevAllForDealBundle:Produit m order by  '%" . $filter . "%''");
        return $query->getResult();
    }
}