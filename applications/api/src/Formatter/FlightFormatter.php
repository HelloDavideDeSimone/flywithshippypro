<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Entity\Flight\Flight;
use App\Repository\Airport\AirportRepository;

class FlightFormatter
{
    private AirportFormatter $airportFormatter;

    private AirportRepository $airportRepository;

    public function __construct(AirportFormatter $airportFormatter, AirportRepository $airportRepository)
    {
        $this->airportFormatter = $airportFormatter;

        $this->airportRepository = $airportRepository;
    }

    /**
     * @return array<string, mixed>
     */
    public function format(Flight $flight): array
    {
        $departureAirport = $this->airportRepository->getAirportByCode($flight->getCodeDeparture());
        $arrivalAirport = $this->airportRepository->getAirportByCode($flight->getCodeArrival());

        $formattedFlight = [];
        $formattedFlight['departureAirport'] = $this->airportFormatter->formatMinimal($departureAirport);
        $formattedFlight['arrivalAirport'] = $this->airportFormatter->formatMinimal($arrivalAirport);
        $formattedFlight['price'] = $flight->getPrice();

        return $formattedFlight;
    }
}
