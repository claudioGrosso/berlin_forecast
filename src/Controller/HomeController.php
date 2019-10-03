<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;

use App\Entity\City;
use App\Entity\Forecast;
use App\Entity\DailyForecast;
use Doctrine\ORM\EntityManagerInterface;


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
        
        $data = $response->toArray();

        $city = new City();
        $city->setName('Berlin');
        $city->setLocationKey('178087');

        $forecast = new Forecast();
        $forecast->setDate($data["Headline"]["EffectiveDate"]);
        $forecast->setEnd($data["Headline"]["EndDate"]);
        $forecast->setText($data["Headline"]["Text"]);
        $forecast->setCityId($city);

        $dailyForecast = $data["DailyForecasts"];

        foreach($dailyForecast as $daily){

            var_dump($daily);
            
            $day = new DailyForecast();
            $day->setDate($day["Date"]);
            $day->setMin($day["Temperature"]["Minimum"]);
            $day->setMax($day["Temperature"]["Maximum"]);
            $day->setDay($day["Day"]);
            $day->setNight($day["Night"]);


        } 





        $responseJson = JsonResponse::fromJsonString('foo');
        
        return $responseJson;

        //return $this->render('home/index.html.twig', ['controller_name' => 'HomeController',]);
    }
}
