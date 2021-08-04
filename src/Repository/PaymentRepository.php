<?php
/**
 *
 * Created by PhpStorm.
 * User: Rozmetov Jasur ( @rozmetovjasur )
 * Date: 03/08/21
 * Time: 10:30
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class PaymentRepository extends EntityRepository
{
    public function filter(array $params): ?array
    {
        $qb = $this->createQueryBuilder('p')
            ->innerJoin('p.method', 'm')
            ->where('m.name = :name')
            ->setParameter('name', $params['name']);
        return $qb->getQuery()
            ->getResult();
    }
}