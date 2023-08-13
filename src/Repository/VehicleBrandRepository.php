<?php

namespace App\Repository;

use App\Entity\VehicleBrand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends ServiceEntityRepository<VehicleBrand>
 *
 * @method VehicleBrand|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleBrand|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleBrand[]    findAll()
 * @method VehicleBrand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleBrandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleBrand::class);
    }

}
