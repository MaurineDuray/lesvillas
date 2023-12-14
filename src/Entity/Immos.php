<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImmosRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ImmosRepository::class)]
class Immos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $TitreEn = null;

    #[ORM\Column]
    private ?int $travellers = null;

    #[ORM\Column]
    private ?int $bedrooms = null;

    #[ORM\Column]
    private ?int $bathrooms = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $priceEn = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionEn = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $logement = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $logementEn = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $equipement = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $equipementEn = null;

    #[ORM\Column(length: 255)]
    private ?string $conciergerie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $calendrier = null;

    #[ORM\Column(length: 255)]
    private ?string $cover = null;

    #[ORM\OneToMany(mappedBy: 'immoId', targetEntity: Images::class)]
    private Collection $images;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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
            $this->slug = $slugify->slugify($this->Titre.'-'.rand());
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getTitreEn(): ?string
    {
        return $this->TitreEn;
    }

    public function setTitreEn(string $TitreEn): static
    {
        $this->TitreEn = $TitreEn;

        return $this;
    }

    public function getTravellers(): ?int
    {
        return $this->travellers;
    }

    public function setTravellers(int $travellers): static
    {
        $this->travellers = $travellers;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): static
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(int $bathrooms): static
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceEn(): ?float
    {
        return $this->priceEn;
    }

    public function setPriceEn(float $priceEn): static
    {
        $this->priceEn = $priceEn;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(string $descriptionEn): static
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function getLogement(): ?string
    {
        return $this->logement;
    }

    public function setLogement(string $logement): static
    {
        $this->logement = $logement;

        return $this;
    }

    public function getLogementEn(): ?string
    {
        return $this->logementEn;
    }

    public function setLogementEn(string $logementEn): static
    {
        $this->logementEn = $logementEn;

        return $this;
    }

    public function getEquipement(): ?string
    {
        return $this->equipement;
    }

    public function setEquipement(string $equipement): static
    {
        $this->equipement = $equipement;

        return $this;
    }

    public function getEquipementEn(): ?string
    {
        return $this->equipementEn;
    }

    public function setEquipementEn(string $equipementEn): static
    {
        $this->equipementEn = $equipementEn;

        return $this;
    }

    public function getConciergerie(): ?string
    {
        return $this->conciergerie;
    }

    public function setConciergerie(string $conciergerie): static
    {
        $this->conciergerie = $conciergerie;

        return $this;
    }

    public function getCalendrier(): ?string
    {
        return $this->calendrier;
    }

    public function setCalendrier(?string $calendrier): static
    {
        $this->calendrier = $calendrier;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setImmoId($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getImmoId() === $this) {
                $image->setImmoId(null);
            }
        }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
