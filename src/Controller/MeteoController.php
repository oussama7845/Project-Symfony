<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MeteoInfo extends AbstractController
{
    #[Route('/meteo/info')]
    public function info(): Response
    {

        $city_name = 'Paris';

        $api_key= 'f599bdc8366647eeb1ee631f9f764947';

        $api_url = 'http://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&appid='.$api_key;

        $weather_data = json_decode( file_get_contents($api_url), true);

        $temperature = $weather_data['main']['temp'];

        $temperature_in_celcius = round($temperature - 273.15);

        $temperature_current_weather = $weather_data['weather'][0]['main'];

        $temperature_current_weather_icon = $weather_data['weather'][0]['icon'];


        return $this->render('meteo/info.html.twig', [
            'city_name' => $city_name,
            'temperature_in_celcius' => $temperature_in_celcius,
            'temperature_current_weather_icon' => $temperature_current_weather_icon,
        ]);
    }
}

?>