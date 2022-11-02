<?php

declare(strict_types=1);

namespace App\Entity\Flight;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Flight\FlightRepository")
 */
class Flight
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true, options={"default": null})
     */
    private ?float $price = null;

    /**
     * @ORM\Column(type="string", nullable=true, options={"default": null})
     */
    private ?string $codeDeparture = null;

    /**
     * @ORM\Column(type="string", nullable=true, options={"default": null})
     */
    private ?string $codeArrival = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getCodeDeparture(): ?string
    {
        return $this->codeDeparture;
    }

    public function setCodeDeparture(?string $codeDeparture): void
    {
        $this->codeDeparture = $codeDeparture;
    }

    public function getCodeArrival(): ?string
    {
        return $this->codeArrival;
    }

    public function setCodeArrival(?string $codeArrival): void
    {
        $this->codeArrival = $codeArrival;
    }
}
