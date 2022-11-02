<?php

declare(strict_types=1);

namespace App\Utility;

use App\Entity\Flight\Flight;
use App\Repository\Flight\FlightRepository;
use Tree\Node\Node;
use Tree\Node\NodeInterface;

class LowestPriceAlogorithm
{
    private FlightRepository $flightRepository;

    public function __construct(FlightRepository $flightRepository)
    {
        $this->flightRepository = $flightRepository;
    }

    public function getNodeWithChildern(NodeInterface $node): NodeInterface
    {
        $childFlights = $this->flightRepository->getDepartureFlightsByCode($node->getValue()->getCodeArrival())->getQuery()->getResult();

        foreach ($childFlights as $flight) {
            $flightNode = new Node($flight);
            $node->addChild($flightNode);
        }

        return $node;
    }

    /**
     * @return array<string, mixed>
     */
    public function nodeCandidateFormatter(NodeInterface $node): array
    {
        $path = [];
        $path['items'] = [];
        $iter = $node;
        $totalPrice = 0;

        while (null !== $iter) {
            if (null !== $iter->getValue()->getCodeDeparture()) {
                $path['items'][] = $iter->getValue();
            }
            $totalPrice += $iter->getValue()->getPrice();
            $iter = $iter->getParent();
        }

        $path['totalPrice'] = $totalPrice;
        $path['items'] = array_reverse($path['items']);

        return $path;
    }

    /**
     * @return array<string, mixed>
     */
    public function getBestPath(string $departureAirportCode, string $arrivalAirportCode): ?array
    {
        $rootFlight = new Flight();
        $rootFlight->setCodeArrival($departureAirportCode);
        $rootFlight->setPrice(0);
        $node = new Node($rootFlight);

        $firstNode = self::getNodeWithChildern($node);

        $children = $firstNode->getChildren();
        $grandChildren = [];
        $GreatGrandChildren = [];
        $candidates = [];
        foreach ($children as $child) {
            if ($child->getValue()->getCodeArrival() == $arrivalAirportCode) {
                $candidates[] = $child;
            }
            $grandChildren = self::getNodeWithChildern($child)->getChildren();

            foreach ($grandChildren as $grandChild) {
                if ($grandChild->getValue()->getCodeArrival() == $arrivalAirportCode) {
                    $candidates[] = $grandChild;
                }
                $GreatGrandChildren = self::getNodeWithChildern($grandChild)->getChildren();

                foreach ($GreatGrandChildren as $GreatGrandChild) {
                    if ($GreatGrandChild->getValue()->getCodeArrival() == $arrivalAirportCode) {
                        $candidates[] = $GreatGrandChild;
                    }
                }
            }
        }
        $prices = [];
        foreach ($candidates as $key => $candidate) {
            $prices[] = self::nodeCandidateFormatter($candidate)['totalPrice'];
        }

        if (0 === \count($prices)) {
            return null;
        }

        return self::nodeCandidateFormatter($candidates[array_search(min($prices), $prices, true)]);
    }
}
