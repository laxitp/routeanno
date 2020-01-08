<?php

namespace App\Repository;

use App\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Questions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questions[]    findAll()
 * @method Questions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questions::class);
    }

    public function findList($sort, $limit, $offset ,$includeUnavailableProducts = false): array
    {
     
        $qb = $this->createQueryBuilder('q')
                ->orderBy('q.rank', $sort)
                ->setMaxResults($limit)
                ->setFirstResult($offset);
        $query = $qb->getQuery();
        return   $query->execute();
        // to get just one result:
        // $product = $query->setMaxResults(1)->getOneOrNullResult();
    }
 
 
}
