<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
#[ORM\Table(name:"plat")]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomP = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixFournisseurP = null;

    #[ORM\Column(nullable: true)]
    private ?bool $platVisible = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoP = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionP = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixClientP = null;

    #[ORM\ManyToOne(targetEntity:"TypePlat", inversedBy:"lesPlats")]
    private ?TypePlat $unTypePlat;
    
    #[ORM\ManyToOne(targetEntity:"Resto", inversedBy:"lesPlats")]
    private ?Resto $unResto;
    
    #[ORM\OneToMany(targetEntity:"Quantite", mappedBy:"unPlat")]
    private ?Collection $lesQuantites;
    
    #[ORM\ManyToMany(targetEntity:"Ingredients", inversedBy:"lesPlats")]
    private ?Collection $lesIngredients;
    
    function __construct() {
        $this->lesMateriaux = new ArrayCollection();
        $this->lesTests = new ArrayCollection();
        $this->lesIngredients = new ArrayCollection();
    }
    
    
    public function getLesIngredients(): ?Collection {
        return $this->lesIngredients;
    }

    public function setLesIngredients(?Collection $lesIngredients): void {
        $this->lesIngredients = $lesIngredients;
    }

       

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomP(): ?string
    {
        return $this->nomP;
    }

    public function setNomP(?string $nomP): static
    {
        $this->nomP = $nomP;

        return $this;
    }

    public function getPrixFournisseurP(): ?float {
        return $this->prixFournisseurP;
    }

    public function setPrixFournisseurP(?float $prixFournisseurP): void {
        $this->prixFournisseurP = $prixFournisseurP;
    }

    
    
    public function isPlatVisible(): ?bool
    {
        return $this->platVisible;
    }

    public function setPlatVisible(?bool $platVisible): static
    {
        $this->platVisible = $platVisible;

        return $this;
    }

    public function getPhotoP(): ?string
    {
        return $this->photoP;
    }

    public function setPhotoP(?string $photoP): static
    {
        $this->photoP = $photoP;

        return $this;
    }

    public function getDescriptionP(): ?string
    {
        return $this->descriptionP;
    }

    public function setDescriptionP(?string $descriptionP): static
    {
        $this->descriptionP = $descriptionP;

        return $this;
    }

    public function getPrixClientP(): ?float
    {
        return $this->prixClientP;
    }

    public function setPrixClientP(?float $prixClientP): static
    {
        $this->prixClientP = $prixClientP;

        return $this;
    }
    
    public function getUnTypePlat(): ?TypePlat {
        return $this->unTypePlat;
    }

    public function getUnResto(): ?Resto {
        return $this->unResto;
    }

    public function getLesQuantites(): ?Collection {
        return $this->lesQuantites;
    }

    public function setUnTypePlat(?TypePlat $unTypePlat): void {
        $this->unTypePlat = $unTypePlat;
    }

    public function setUnResto(?Resto $unResto): void {
        $this->unResto = $unResto;
    }

    public function setLesQuantites(?Collection $lesQuantites): void {
        $this->lesQuantites = $lesQuantites;
    }


}
