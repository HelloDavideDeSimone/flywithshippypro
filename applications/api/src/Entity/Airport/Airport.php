<?php

declare(strict_types=1);

namespace App\Entity\Airport;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Airport\AirportRepository")
 */
class Airport
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
    private ?float $lat = null;

    /**
     * @ORM\Column(type="float", nullable=true, options={"default": null})
     */
    private ?float $lng = null;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    private string $code;

    /**
     * @ORM\Column(type="string", nullable=true, options={"default": null})
     */
    private ?string $name = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(?float $lat): void
    {
        $this->lat = $lat;
    }

    public function getLng(): ?float
    {
        return $this->lng;
    }

    public function setLng(?float $lng): void
    {
        $this->lng = $lng;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
