<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\ServiceInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ServiceInfoRepository $serviceInfoRepository,CustomerRepository $customerRepository): Response
    {
//        if (!$this->isGranted('ROLE_USER')){
//            throw $this->createAccessDeniedException('No access for you');
//        }

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
