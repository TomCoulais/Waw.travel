<?php

// src/Entity/Checkpoint.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CheckpointRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CheckpointRepository::class)]
#[ORM\Table(name: '`checkpoint`')]  
class Checkpoint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(length: 255)]
    private ?string $spotName;

    #[ORM\Column(length :255)]
    private ?string $googleMapsCoords;

    #[ORM\ManyToOne(targetEntity: "App\Entity\RoadTrip")]
    #[ORM\JoinColumn(nullable: false)]
    private $roadTrip;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpotName(): ?string
    {
        return $this->spotName;
    }

    public function setSpotName(string $spotName): self
    {
        $this->spotName = $spotName;

        return $this;
    }

    public function getGoogleMapsCoords(): ?string
    {
        return $this->googleMapsCoords;
    }

    public function setGoogleMapsCoords(string $googleMapsCoords): self
    {
        $this->googleMapsCoords = $googleMapsCoords;

        return $this;
    }

    public function getRoadTrip(): ?RoadTrip
    {
        return $this->roadTrip;
    }

    public function setRoadTrip(?RoadTrip $roadTrip): self
    {
        $this->roadTrip = $roadTrip;

        return $this;
    }
}

