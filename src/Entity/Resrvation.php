<?php

namespace App\Entity;

use App\Repository\ResrvationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResrvationRepository::class)]
class Resrvation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbAnimals = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbAnimals(): ?int
    {
        return $this->nbAnimals;
    }

    public function setNbAnimals(?int $nbAnimals): static
    {
        $this->nbAnimals = $nbAnimals;

        return $this;
    }
}
