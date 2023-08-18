<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\ServiceInfo;
use App\Repository\CustomerRepository;
use App\Repository\ServiceInfoRepository;
use App\Service\VehicleService;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class VehicleController extends AbstractController
{
    #[Route('/vehicles', name: 'app_vehicles')]
    public function list(ServiceInfoRepository $serviceInfoRepository): Response
    {

        $serviceInfos = $serviceInfoRepository->getServiceInfo();

        return $this->render('vehicle/list.html.twig', [
            'controller_name' => 'VehicleController',
            'servicesInfos'=>$serviceInfos
        ]);
    }

    #[Route('/vehicle/add', name: 'app_vehicle_add')]
    public function add(VehicleService $vehicleService, Request $request, EntityManagerInterface $entityManager): Response
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

        if ($request->getMethod() === Request::METHOD_POST){

            $customer = new Customer();
            $customer->setFirstname($request->request->get('firstname'));
            $customer->setSurname($request->request->get('lastname'));
            $customer->setPhoneNumber($request->request->get('phoneNumber'));
            $customer->setAddress($request->request->get('address'));
            $customer->setCreatedAt(new \DateTime());
            $customer->setUpdatedAt(new \DateTime());
            $entityManager->persist($customer);


            $serviceInfo = new ServiceInfo();
            $serviceInfo->setStatus($request->request->get('status'));
            $serviceInfo->setCustomer($customer);
            $serviceInfo->setVehicleProblem($request->request->get('vehicleProblem'));
            $serviceInfo->setVehicleBrand($request->request->get('brand'));
            $serviceInfo->setVehicleModel($request->request->get('model'));
            $serviceInfo->setExpert($request->request->get('expert'));
            $serviceInfo->setRepairDate(new \DateTime($request->request->get('repairDate')));
            $serviceInfo->setCreatedAt(new \DateTime());
            $serviceInfo->setUpdatedAt(new \DateTime());
            $entityManager->persist($serviceInfo);
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicles');
            }


        return $this->render('vehicle/add.html.twig', [
            'controller_name' => 'VehicleController',
            'brands'=> json_decode($vehicleService->getVehicleBrands()->getContent()),
            'experts'=> $vehicleService->experts(),
            'vehicleStatus'=>$vehicleService->vehicleStatus()
        ]);
    }

}
