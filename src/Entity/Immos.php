<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImmosRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ImmosRepository::class)]
class Immos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le titre du logement doit être mentionné")]
    #[Assert\Length(min: 2, max:255, minMessage:"Le titre doit faire au minimum 2 caractères", maxMessage: "Le titre ne peut dépasser 255 caractères")]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le titre du logement doit être mentionné")]
    #[Assert\Length(min: 2, max:255, minMessage:"Le titre doit faire au minimum 2 caractères", maxMessage: "Le titre ne peut dépasser 255 caractères")]
    private ?string $TitreEn = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le nombre de voyageurs maximum doit être mentionné")]
    private ?int $travellers = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le nombre de chambre(s) doit être mentionné")]
    private ?int $bedrooms = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le nombre de salle(s) de bain doit être mentionné")]
    private ?int $bathrooms = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le prix par nuit doit être mentionné")]
    private ?float $price = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le prix par nuit doit être mentionné")]
    private ?float $priceEn = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Une description en français doit être mentionnée")]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Une description en anglais doit être mentionnée")]
    private ?string $descriptionEn = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La composition du logement en français doit être fournie ")]
    private ?string $logement = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La composition du logement en anglais doit être fournie")]
    private ?string $logementEn = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"L'équipement' du logement en français doit être fournie ")]
    private ?string $equipement = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"L'équipement' du logement en anglais doit être fournie ")]
    private ?string $equipementEn = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La conciergerie du logement doit être mentionnée")]
    private ?string $conciergerie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $calendrier = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"L'image principale du logement doit être fournie")]
    #[Assert\Image(mimeTypes:["image/png","image/jpeg","image/jpg","image/gif"], mimeTypesMessage:"Vous devez ajouter un fichier jpg, jpeg, png ou gif")]
    #[Assert\File(maxSize:"2024k", maxSizeMessage:"La taille du fichier est trop grande")]
    private ?string $cover = null;

    #[ORM\OneToMany(mappedBy: 'immoId', targetEntity: Images::class)]
    private Collection $images;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le type du logement doit être sélectionné")]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'immoId', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\Column(nullable: true)]
    private ?bool $piscine = null;

    #[ORM\Column(nullable: true)]
    private ?bool $animals = null;

    #[ORM\Column]
    private ?bool $seafront = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeEn = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le titre du logement doit être mentionné")]
    #[Assert\Length(min: 2, max:255, minMessage:"Le titre doit faire au minimum 2 caractères", maxMessage: "Le titre ne peut dépasser 255 caractères")]
    private ?string $TitreEs = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"Une description en espagnol doit être mentionnée")]
    private ?string $descriptionEs = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La composition du logement en espagnol doit être fournie")]
    private ?string $logementEs = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"L'équipement' du logement en espagnol doit être fournie ")]
    private ?string $equipementEs = null;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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
            $this->slug = $slugify->slugify(rand());
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setImmoId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getImmoId() === $this) {
                $reservation->setImmoId(null);
            }
        }

        return $this;
    }

    public function isPiscine(): ?bool
    {
        return $this->piscine;
    }

    public function setPiscine(?bool $piscine): static
    {
        $this->piscine = $piscine;

        return $this;
    }

    public function isAnimals(): ?bool
    {
        return $this->animals;
    }

    public function setAnimals(?bool $animals): static
    {
        $this->animals = $animals;

        return $this;
    }

    public function isSeafront(): ?bool
    {
        return $this->seafront;
    }

    public function setSeafront(bool $seafront): static
    {
        $this->seafront = $seafront;

        return $this;
    }

    public function getTypeEn(): ?string
    {
        return $this->typeEn;
    }

    public function setTypeEn(string $typeEn): static
    {
        $this->typeEn = $typeEn;

        return $this;
    }

    public function getTitreEs(): ?string
    {
        return $this->TitreEs;
    }

    public function setTitreEs(string $TitreEs): static
    {
        $this->TitreEs = $TitreEs;

        return $this;
    }

    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    public function setDescriptionEs(string $descriptionEs): static
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    public function getLogementEs(): ?string
    {
        return $this->logementEs;
    }

    public function setLogementEs(string $logementEs): static
    {
        $this->logementEs = $logementEs;

        return $this;
    }

    public function getEquipementEs(): ?string
    {
        return $this->equipementEs;
    }

    public function setEquipementEs(string $equipementEs): static
    {
        $this->equipementEs = $equipementEs;

        return $this;
    }
}
