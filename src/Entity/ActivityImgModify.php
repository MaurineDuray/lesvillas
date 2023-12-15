<?php 

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ActivityImgModify{

    #[Assert\Image(mimeTypes:["image/png","image/jpeg","image/jpg"], mimeTypesMessage:"Vous devez upload un fichier jpg, jpeg, png")]
    #[Assert\File(maxSize:"1024k", maxSizeMessage:"La taille du fichier est trop grande")]
    private ?string $newImage = null;

    public function getNewImage(): ?string
    {
        return $this->newImage;
    }

    public function setNewImage(?string $newImage): self
    {
        $this->newImage = $newImage;

        return $this;
    }
}
