<?php

declare(strict_types=1);

namespace App\Formatter;

use App\Entity\Airport\Airport;

class AirportFormatter
{
    /**
     * @return array<string, mixed>
     */
    public function format(Airport $airport): array
    {
        $formattedAirport = [];
        $formattedAirport['id'] = $airport->getId();
        $formattedAirport['lat'] = $airport->getLat();
        $formattedAirport['lng'] = $airport->getLng();
        $formattedAirport['name'] = $airport->getName();
        $formattedAirport['code'] = $airport->getCode();

        return $formattedAirport;
    }

    /**
     * @return array<string, mixed>
     */
    public function formatMinimal(Airport $airport): array
    {
        $formattedAirport = [];
        $formattedAirport['text'] = $airport->getName();
        $formattedAirport['value'] = $airport->getCode();

        return $formattedAirport;
    }
}
