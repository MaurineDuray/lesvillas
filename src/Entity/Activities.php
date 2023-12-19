<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ActivitiesRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActivitiesRepository::class)]
class Activities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le titre de l'activité doit être mentionné")]
    #[Assert\Length(min: 2, max:255, minMessage:"Le titre de l'activité doit faire au minimum 2 caractères", maxMessage: "Le titre de l'activité ne peut dépasser 255 caractères")]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le titre anglais de l'activité doit être mentionné")]
    #[Assert\Length(min: 2, max:255, minMessage:"Le titre de l'activité doit faire au minimum 2 caractères", maxMessage: "Le titre de l'activité ne peut dépasser 255 caractères")]
    private ?string $titreEn = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptionEn = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"L'image de l'activité doit être fournie")]
    #[Assert\Image(mimeTypes:["image/png","image/jpeg","image/jpg","image/gif"], mimeTypesMessage:"Vous devez ajouter un fichier jpg, jpeg, png ou gif")]
    #[Assert\File(maxSize:"2024k", maxSizeMessage:"La taille du fichier est trop grande")]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $localisation = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

     /**
     * Initialisation automatique du slug 
     *
     * @return void
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function initializeSlug():void{
        if (empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->titre.'-'.rand());
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitreEn(): ?string
    {
        return $this->titreEn;
    }

    public function setTitreEn(string $titreEn): static
    {
        $this->titreEn = $titreEn;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(?string $descriptionEn): static
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
