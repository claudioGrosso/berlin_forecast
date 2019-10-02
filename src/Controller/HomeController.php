<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Language;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $url = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/178087?";
        $parameters = [
            'apikey' => 'Id6yp6M6v0WhuuYyrjfjdFGCWa7jBGCh',
            'language' => 'en-us',
            'details' => false,
            'metric' => false
        ];

        $query = http_build_query($parameters);

        $client = HttpClient::create();
        $response = $client->request('GET', $url.$query);

        $responseJson = JsonResponse::fromJsonString($response->getContent());
        
        return $responseJson;

        //return $this->render('home/index.html.twig', ['controller_name' => 'HomeController',]);
    }
}
