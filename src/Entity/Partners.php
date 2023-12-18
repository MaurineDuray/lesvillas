<?php

namespace App\Entity;

use App\Repository\PartnersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PartnersRepository::class)]
class Partners
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    
    private ?string $logo = null;
    #[Assert\NotBlank(message:"L'image de l'activité doit être fournie")]
    #[Assert\Image(mimeTypes:["image/png","image/jpeg","image/jpg","image/gif"], mimeTypesMessage:"Vous devez ajouter un fichier jpg, jpeg, png ou gif")]
    #[Assert\File(maxSize:"1024k", maxSizeMessage:"La taille du fichier est trop grande")]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
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
}
