<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"L'image de l'activité doit être fournie")]
    #[Assert\Image(mimeTypes:["image/png","image/jpeg","image/jpg","image/gif"], mimeTypesMessage:"Vous devez ajouter un fichier jpg, jpeg, png ou gif")]
    #[Assert\File(maxSize:"1024k", maxSizeMessage:"La taille du fichier est trop grande")]
    private ?string $file = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?Immos $immoId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): static
    {
        $this->file = $file;

        return $this;
    }

    public function getImmoId(): ?Immos
    {
        return $this->immoId;
    }

    public function setImmoId(?Immos $immoId): static
    {
        $this->immoId = $immoId;

        return $this;
    }
}
