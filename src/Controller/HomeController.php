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

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($city);
        $entityManager->persist($forecast);
        
        
        $dailyForecast = $data["DailyForecasts"];
        $weathers = array();
        
        foreach($dailyForecast as $daily){
                        
            $day = new DailyForecast();
            $day->setDate($daily["Date"]);
            $day->setMin($daily["Temperature"]["Minimum"]["Value"]);
            $day->setMax($daily["Temperature"]["Maximum"]["Value"]);
            $day->setDay($daily["Day"]["IconPhrase"]);
            $day->setNight($daily["Night"]["IconPhrase"]);
            $day->setForecastId($forecast);
            
            $entityManager->persist($day);
            
            $weather = array(
                'date' => $day->getDate(),
                'min' => $day->getMin(),
                'max' => $day->getMax(),
                'day' => $day->getDay(),
                'night' => $day->getNight(),
            );

            array_push($weathers, $weather);
            
        }         
        
        
        $entityManager->flush();
        
        return $this->render('home/show.html.twig', ['forecast' => $forecast->getText(),'weathers' => $weathers]);
                
    }
}
