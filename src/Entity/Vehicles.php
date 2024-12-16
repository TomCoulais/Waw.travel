<?php

// src/Entity/Vehicle.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VehiclesRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CheckpointRepository::class)]
#[ORM\Table(name: '`vehicles`')]  
class Vehicle
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?integer $id;

    
    #[ORM\Column(length:255)]
    private ?string $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}

