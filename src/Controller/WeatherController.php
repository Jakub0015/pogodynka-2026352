<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\ForecastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{country}/{name}', name: 'app_weather', requirements: ['country' => '[A-Z]{2}'])]
    public function name(
        #[MapEntity(mapping: ['country' => 'country', 'name' => 'name'])]
        Location $location,
        ForecastRepository $repository
    ): Response {
        $forecast = $repository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'forecast' => $forecast,
        ]);
    }
}
