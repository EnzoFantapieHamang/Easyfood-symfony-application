<?php

namespace App\Entity;

use App\Repository\QuantiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"quantite")]
class Quantite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPlat = null;
    
    #[ORM\ManyToOne(targetEntity:"Plat", inversedBy:"lesQuantites")]
    private ?Plat $unPlat;
    
    #[ORM\ManyToOne(targetEntity:"Commande", inversedBy:"lesQuantites")]
    private ?Commande $uneCommande;

    
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlat(): ?int
    {
        return $this->nbPlat;
    }
    
    public function getUnPlat(): ?Plat {
        return $this->unPlat;
    }

    public function getUneCommande(): ?Commande {
        return $this->uneCommande;
    }

    public function setUnPlat(?Plat $unPlat): void {
        $this->unPlat = $unPlat;
    }

    public function setUneCommande(?Commande $uneCommande): void {
        $this->uneCommande = $uneCommande;
    }

    
    public function setNbPlat(?int $nbPlat): static
    {
        $this->nbPlat = $nbPlat;

        return $this;
    }
}
