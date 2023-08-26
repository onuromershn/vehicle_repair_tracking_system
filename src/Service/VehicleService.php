<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\Translation\t;

class VehicleService
{
    private $apiKey;
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return Response
     */
    public function getVehicleBrands(): Response
    {
        $curl =  curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://car-api2.p.rapidapi.com/api/makes?direction=asc&sort=id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: car-api2.p.rapidapi.com",
                "X-RapidAPI-Key:".$this->apiKey." "
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $response = json_decode($response)->data;

        return  new JsonResponse($response);
    }

    /**
     * @return Response
     */
    public function getVehicleModels(int $makeId): Response
    {
        $curl =  curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://car-api2.p.rapidapi.com/api/models?year=2020&make_id=$makeId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: car-api2.p.rapidapi.com",
                "X-RapidAPI-Key: a38f26dc45mshc9e4044ba3f8cfdp11d00bjsn429051572ba9"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $response = json_decode($response)->data;
        return  new JsonResponse($response);
    }

    public function experts()
    {
        $experts = ["Expert-A","Expert-B","Expert-C","Expert-D","Expert-E"];

        return $experts;
    }

    public function vehicleStatus()
    {
        $vehicleStatus = ["To Do","In Progress","Done"];

        return $vehicleStatus;
    }
}