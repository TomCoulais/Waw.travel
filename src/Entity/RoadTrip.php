<?php
// src/Entity/RoadTrip.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RoadTripRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: RoadTripRepository::class)]
#[ORM\Table(name: '`road_trip`')]
class RoadTrip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $title;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $cover_image;

    #[ORM\ManyToOne(targetEntity: "App\Entity\Vehicle")]
    #[ORM\JoinColumn(name: "vehicle_id", referencedColumnName: "id", nullable: false)]
    private $vehicle;

    #[ORM\ManyToOne(targetEntity: "App\Entity\User")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id", nullable: false)]
    private $user;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $startDate;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $endDate;

    #[ORM\Column(type: "boolean", options: ['default' => false])]
    private bool $isCommunity = false;

    #[ORM\OneToMany(mappedBy: 'roadTrip', targetEntity: Checkpoint::class, cascade: ['persist', 'remove'])]
    private Collection $checkpoints;

    public function __construct()
    {
        $this->checkpoints = new ArrayCollection();
    }

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
    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }
    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
    public function getIsCommunity(): bool
    {
        return $this->isCommunity;
    }

    public function setIsCommunity(bool $isCommunity): self
    {
        $this->isCommunity = $isCommunity;

        return $this;
    }
    public function getCheckpoints(): Collection
    {
        return $this->checkpoints;
    }

    public function addCheckpoint(Checkpoint $checkpoint): self
    {
        if (!$this->checkpoints->contains($checkpoint)) {
            $this->checkpoints[] = $checkpoint;
            $checkpoint->setRoadTrip($this); 
        }

        return $this;
    }

    public function removeCheckpoint(Checkpoint $checkpoint): self
    {
        if ($this->checkpoints->removeElement($checkpoint)) {
            if ($checkpoint->getRoadTrip() === $this) {
                $checkpoint->setRoadTrip(null);
            }
        }

        return $this;
    }
}
