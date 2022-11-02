<?php

declare(strict_types=1);

namespace App\Controller\Api\Flight;

use App\Controller\Api\ApiBaseController;
use App\Formatter\AirportFormatter;
use App\Formatter\FlightFormatter;
use App\Repository\Airport\AirportRepository;
use App\Utility\LowestPriceAlogorithm;
use App\Utility\VariablesUtility;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetLowestPriceController extends ApiBaseController
{
    private AirportRepository $airportRepository;
    private AirportFormatter  $airportFormatter;
    private FlightFormatter  $flightFormatter;
    private LowestPriceAlogorithm $lowestPriceAlogorithm;

    public function __construct(AirportFormatter $airportFormatter, FlightFormatter $flightFormatter, LowestPriceAlogorithm $lowestPriceAlogorithm, AirportRepository $airportRepository)
    {
        $this->airportFormatter = $airportFormatter;
        $this->flightFormatter = $flightFormatter;
        $this->lowestPriceAlogorithm = $lowestPriceAlogorithm;
        $this->airportRepository = $airportRepository;
    }

    /**
     * @Route(path="/flights", methods={"POST"})
     */
    public function __invoke(Request $request): Response
    {
        $departureAirportCode = VariablesUtility::getStringOrNull($request->request->get('departureAirportCode'));
        $arrivalAirportCode = VariablesUtility::getStringOrNull($request->request->get('arrivalAirportCode'));

        if ($departureAirportCode === $arrivalAirportCode) {
            return new JsonResponse(['msg' => 'Departure airport and arrival airport are the same!'], Response::HTTP_BAD_REQUEST);
        }

        if (null === $departureAirportCode || null === $arrivalAirportCode) {
            return new JsonResponse(['msg' => 'Airports are required'], Response::HTTP_BAD_REQUEST);
        }

        $departureAirport = $this->airportRepository->findOneBy(['code' => $departureAirportCode]);
        $arrivalAirport = $this->airportRepository->findOneBy(['code' => $arrivalAirportCode]);

        if (null === $departureAirport || null === $arrivalAirport) {
            return new JsonResponse(['msg' => 'Airports not found'], Response::HTTP_BAD_REQUEST);
        }

        $path = $this->lowestPriceAlogorithm->getBestPath($departureAirportCode, $arrivalAirportCode);

        if (null === $path) {
            return new JsonResponse(['msg' => 'No route was found :('], Response::HTTP_BAD_REQUEST);
        }

        $formattedFlights = [];
        foreach ($path['items'] as $flight) {
            $formattedFlights[] = $this->flightFormatter->format($flight);
        }

        return new JsonResponse([
            'showing' => [
                'from' => $this->airportFormatter->formatMinimal($departureAirport),
                'to' => $this->airportFormatter->formatMinimal($arrivalAirport),
            ],
            'flights' => $formattedFlights,
            'totalPrice' => number_format($path['totalPrice'], 2, '.', ','),
        ]);
    }
}
