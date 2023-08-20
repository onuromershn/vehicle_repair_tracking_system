<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\ServiceInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServiceInfo>
 *
 * @method ServiceInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceInfo[]    findAll()
 * @method ServiceInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceInfo::class);
    }

    public function getServiceInfo()
    {
        $qb = $this->_em->createQueryBuilder();

        return $qb->select('si')
            ->from(ServiceInfo::class,'si')
            ->orderBy('si.id','DESC')
            ->getQuery()
            ->getResult();
    }

    public function getTotalVehicles()
    {
        $qb = $this->_em->createQueryBuilder();

        return $qb->select('COUNT(si.id) as count')
            ->from(ServiceInfo::class,'si')
            ->getQuery()
            ->getResult();
    }
}
