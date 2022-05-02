<?php

namespace App\Entity;

use App\Models\Sport;
use App\Repository\MainSportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainSportRepository::class)]
class MainSport extends Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $distance;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $elevationGain;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $elevationLoss;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getElevationGain(): ?int
    {
        return $this->elevationGain;
    }

    public function setElevationGain(?int $elevationGain): self
    {
        $this->elevationGain = $elevationGain;

        return $this;
    }

    public function getElevationLoss(): ?int
    {
        return $this->elevationLoss;
    }

    public function setElevationLoss(?int $elevationLoss): self
    {
        $this->elevationLoss = $elevationLoss;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
