<?php

declare(strict_types=1);

namespace App\Controller\Api\Airport;

use App\Controller\Api\ApiBaseController;
use App\Entity\Airport\Airport;
use App\Formatter\AirportFormatter;
use App\Repository\Airport\AirportRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListAirportsController extends ApiBaseController
{
    private AirportRepository $airportRepository;

    private AirportFormatter  $airportFormatter;

    public function __construct(AirportRepository $airportRepository, AirportFormatter $airportFormatter)
    {
        $this->airportRepository = $airportRepository;
        $this->airportFormatter = $airportFormatter;
    }

    /**
     * @Route(path="/airports", methods={"GET"})
     */
    public function __invoke(Request $request): Response
    {
        $airports = $this->airportRepository->findAll();

        $formattedAirports = [];
        /** @var Airport $airport */
        foreach ($airports as $airport) {
            $formattedAirports[] = $this->airportFormatter->formatMinimal($airport);
        }

        return new JsonResponse(['airports' => $formattedAirports]);
    }
}
