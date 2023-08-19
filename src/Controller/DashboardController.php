<?php

namespace App\Controller;

use App\Repository\ServiceInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ServiceInfoRepository $serviceInfoRepository): Response
    {
        $serviceInfos = $serviceInfoRepository->getServiceInfo();

        return $this->render('dashboard/dashboard.html.twig', [
            'controller_name' => 'DashboardController',
            'servicesInfos'=>$serviceInfos
        ]);
    }
}
