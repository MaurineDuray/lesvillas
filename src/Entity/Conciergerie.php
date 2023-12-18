<?php

namespace App\Entity;

use App\Repository\ConciergerieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConciergerieRepository::class)]
class Conciergerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Vous devez mentionner votre nom / Please enter your name")]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Vous devez mentionner votre email / Please enter your email")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Vous devez mentionner votre numéro de téléphone / Please enter your phone")]
    private ?string $phone = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Vous devez mentionner la superficie du logement / Please enter the surface area of the accommodation ")]
    private ?int $superficie = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Vous devez mentionner l'adresse du logement / Please enter th address of the accomodation")]
    private ?string $adress = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Veuillez remplir le champ message / Please enter your message")]
    private ?string $message = null;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(int $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): static
    {
        $this->adress = $adress;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }
}
