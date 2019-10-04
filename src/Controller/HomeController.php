<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;

use App\Entity\Forecast;
use App\Entity\DailyForecast;
use App\Entity\Weather;
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

        $forecast = new Forecast();
        $forecast->setDate($data["Headline"]["EffectiveEpochDate"]);
        $forecast->setText($data["Headline"]["Text"]);
        $forecast->setLink($data["Headline"]["Link"]);
       
        $entityManager = $this->getDoctrine()->getManager();
        
        $entityManager->persist($forecast);

        $dailyForecast = $data["DailyForecasts"];
        $weathers = array();
        
        foreach($dailyForecast as $daily){

            $dayWeather = new Weather();
            $dayWeather->setLight('Day');
            $dayWeather->setPhrase($daily["Day"]["IconPhrase"]);
            $dayWeather->setPrecipitation($daily["Day"]["HasPrecipitation"]);
            if ($dayWeather->getPrecipitation()) {
                
                $dayWeather->setType($daily["Day"]["PrecipitationType"]);
                $dayWeather->setIntensity($daily["Day"]["PrecipitationIntensity"]);
                
            }

            $nightWeather = new Weather();
            $nightWeather->setLight('Night');
            $nightWeather->setPhrase($daily["Night"]["IconPhrase"]);
            $nightWeather->setPrecipitation($daily["Night"]["HasPrecipitation"]);
            if ($nightWeather->getPrecipitation()) {

                $nightWeather->setType($daily["Night"]["PrecipitationType"]);
                $nightWeather->setIntensity($daily["Night"]["PrecipitationIntensity"]);
                
            }
                        
            $day = new DailyForecast();
            $day->setDate($daily["EpochDate"]);
            $day->setMin($daily["Temperature"]["Minimum"]["Value"]);
            $day->setMax($daily["Temperature"]["Maximum"]["Value"]);
            $day->setForecast($forecast);
            $day->addWeather($dayWeather);
            $day->addWeather($nightWeather);
            
            $entityManager->persist($dayWeather);
            $entityManager->persist($nightWeather);
            $entityManager->persist($day);
            
            $weather = array(
                'date' => date("l d-M-Y",$day->getDate()),
                'min' => $day->getMin(),
                'max' => $day->getMax(),
                'day_precipitation' => $dayWeather->getPrecipitation(),
                'day' => $dayWeather->getPhrase(),
                'night_precipitation' => $nightWeather->getPrecipitation(),
                'night' => $nightWeather->getPhrase()
            );

            array_push($weathers, $weather);
            
        }         

        $entityManager->flush();
        
        return $this->render('home/show.html.twig', [
            'forecast' => $forecast->getText(),
            'weathers' => $weathers
        ]);
                
    }
}
