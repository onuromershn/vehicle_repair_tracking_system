<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\ServiceInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ServiceInfoRepository $serviceInfoRepository,CustomerRepository $customerRepository): Response
    {
        $serviceInfos = $serviceInfoRepository->getServiceInfo();
        $totalCustomer = $customerRepository->getTotalCustomer()[0]['count'];
        $totalVehicle = $serviceInfoRepository->getTotalVehicles()[0]['count'];

        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
            'servicesInfos'=>$serviceInfos,
            'totalCustomer'=>$totalCustomer,
            'totalVehicle'=>$totalVehicle
        ]);
    }
}
