<?php

namespace App\Entity;

use App\Repository\VehicleModelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleModelRepository::class)]
class VehicleModel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'vehicleModels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?VehicleBrand $vehicleBrand = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getVehicleBrand(): ?VehicleBrand
    {
        return $this->vehicleBrand;
    }

    public function setVehicleBrand(?VehicleBrand $vehicleBrand): static
    {
        $this->vehicleBrand = $vehicleBrand;

        return $this;
    }
}
