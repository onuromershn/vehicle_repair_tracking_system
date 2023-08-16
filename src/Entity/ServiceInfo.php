<?php

namespace App\Entity;

use App\Repository\ServiceInfoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceInfoRepository::class)]
class ServiceInfo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'serviceInfos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(length: 255)]
    private ?string $vehicle_brand = null;

    #[ORM\Column(length: 255)]
    private ?string $vehicle_model = null;

    #[ORM\Column(length: 50)]
    private ?string $status = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $vehicle_problem = null;

    #[ORM\Column(length: 50)]
    private ?string $expert = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $repair_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getVehicleBrand(): ?string
    {
        return $this->vehicle_brand;
    }

    public function setVehicleBrand(string $vehicle_brand): static
    {
        $this->vehicle_brand = $vehicle_brand;

        return $this;
    }

    public function getVehicleModel(): ?string
    {
        return $this->vehicle_model;
    }

    public function setVehicleModel(string $vehicle_model): static
    {
        $this->vehicle_model = $vehicle_model;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getVehicleProblem(): ?string
    {
        return $this->vehicle_problem;
    }

    public function setVehicleProblem(string $vehicle_problem): static
    {
        $this->vehicle_problem = $vehicle_problem;

        return $this;
    }

    public function getExpert(): ?string
    {
        return $this->expert;
    }

    public function setExpert(string $expert): static
    {
        $this->expert = $expert;

        return $this;
    }

    public function getRepairDate(): ?\DateTimeInterface
    {
        return $this->repair_date;
    }

    public function setRepairDate(\DateTimeInterface $repair_date): static
    {
        $this->repair_date = $repair_date;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
