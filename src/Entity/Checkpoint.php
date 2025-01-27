<?php

    namespace App\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use App\Repository\CheckpointRepository;

    #[ORM\Entity(repositoryClass: CheckpointRepository::class)]
    #[ORM\Table(name: '`checkpoint`')]  
    class Checkpoint
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id;

        #[ORM\Column(length: 255)]
        private ?string $spotName;

        #[ORM\Column(length :255)]
        private ?float $longitude;

        #[ORM\Column(length :255)]
        private ?float $latitude;

        #[ORM\ManyToOne(targetEntity: "App\Entity\RoadTrip", inversedBy: "checkpoints")]
        #[ORM\JoinColumn(nullable: false)]
        private ?RoadTrip $roadTrip;

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

        public function getLongitude(): ?float
        {
            return $this->longitude;
        }

        public function setLongitude(float $longitude): self
        {
            $this->longitude = $longitude;

            return $this;
        }

        public function getLatitude(): ?float
        {
            return $this->latitude;
        }

        public function setLatitude(float $latitude): self
        {
            $this->latitude = $latitude;

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


