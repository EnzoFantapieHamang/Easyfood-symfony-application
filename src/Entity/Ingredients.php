<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $libelleI = null;
    
    #[ORM\ManyToMany(targetEntity:"Plat", mappedBy:"lesIngredients")]
    private ?Collection $lesPlats;
    
    function __construct() {
        $this->lesPlats = new ArrayCollection();
        
    }
    
    public function getLesPlats(): ?Collection {
        return $this->lesPlats;
    }

    public function setLesPlats(?Collection $lesPlats): void {
        $this->lesPlats = $lesPlats;
    }

        
    public function getUnPlat(): ?Plat {
        return $this->unPlat;
    }

    public function setUnPlat(?Plat $unPlat): void {
        $this->unPlat = $unPlat;
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLibelleI(): ?string
    {
        return $this->libelleI;
    }

    public function setLibelleI(?string $libelleI): static
    {
        $this->libelleI = $libelleI;

        return $this;
    }
}
