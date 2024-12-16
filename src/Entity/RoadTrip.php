<?php

// src/Entity/RoadTrip.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Repository\RoadTripRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CheckpointRepository::class)]
#[ORM\Table(name: '`road_trip`')]  
class RoadTrip
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?integer $id;

    private ?string $cover_image;

    private ?string $title;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Vehicle")]
    #[ORM\JoinColumn(name:"vehicle_id", referencedColumnName:"id", nullable:false)]
    private $vehicle;

    #[ORM\ManyToOne(targetEntity:"App\Entity\User")]
    #[ORM\JoinColumn(name:"user_id", referencedColumnName:"id", nullable:false)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(string $cover_image): self
    {
        $this->cover_image = $cover_image;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

