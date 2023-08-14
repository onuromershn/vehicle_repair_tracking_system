<?php

namespace App\Controller;

use App\Service\VehicleService;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

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
    public function add(VehicleService $vehicleService, Request $request): Response
    {

        if ($request->request->get('type')=='getModel'){
            $id = $request->request->get('id');
            $models = json_decode($vehicleService->getVehicleModels($id)->getContent());

            $models = array_map(function ($model){
                return [
                    'id' => $model->make_id,
                    'name' => $model->name
                ];
            },$models);

            return $this->json($models);
        }

        return $this->render('vehicle/add.html.twig', [
            'controller_name' => 'VehicleController',
            'brands'=> json_decode($vehicleService->getVehicleBrands()->getContent()),
        ]);
    }

}
