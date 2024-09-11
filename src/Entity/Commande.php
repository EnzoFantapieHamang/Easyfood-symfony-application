<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"commande")]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaireClientC = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLivrC = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modeReglementC = null;
    
    #[ORM\ManyToOne(targetEntity:"User", inversedBy:"lesCommandes")]
    private ?User $unUser;
    
    #[ORM\OneToMany(targetEntity:"Quantite", mappedBy:"uneCommande")]
    private ?Collection $lesQuantites;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->dateC;
    }

    public function setDateC(?\DateTimeInterface $dateC): static
    {
        $this->dateC = $dateC;

        return $this;
    }

    public function getCommentaireClientC(): ?string
    {
        return $this->commentaireClientC;
    }

    public function setCommentaireClientC(?string $commentaireClientC): static
    {
        $this->commentaireClientC = $commentaireClientC;

        return $this;
    }

    public function getDateLivrC(): ?\DateTimeInterface
    {
        return $this->dateLivrC;
    }

    public function setDateLivrC(?\DateTimeInterface $dateLivrC): static
    {
        $this->dateLivrC = $dateLivrC;

        return $this;
    }

    public function getModeReglementC(): ?string
    {
        return $this->modeReglementC;
    }

    public function setModeReglementC(?string $modeReglementC): static
    {
        $this->modeReglementC = $modeReglementC;

        return $this;
    }
    
    public function getUnUser(): ?User {
        return $this->unUser;
    }

    public function getLesQuantites(): ?Collection {
        return $this->lesQuantites;
    }

    public function setUnUser(?User $unUser): void {
        $this->unUser = $unUser;
    }

    public function setLesQuantites(?Collection $lesQuantites): void {
        $this->lesQuantites = $lesQuantites;
    }


}
