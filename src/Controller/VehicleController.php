<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    #[Route('/vehicles', name: 'app_vehicles')]
    public function list(): Response
    {
        return $this->render('vehicle/list.html.twig', [
            'controller_name' => 'VehicleController',
        ]);
    }

    #[Route('/vehicle/add', name: 'app_vehicle_add')]
    public function add(): Response
    {
        return $this->render('vehicle/add.html.twig', [
            'controller_name' => 'VehicleController',
        ]);
    }
}
