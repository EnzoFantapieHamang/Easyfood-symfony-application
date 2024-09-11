<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"resto")]
class Resto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numAdrR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rueAdrR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cpR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $villeR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $horairesR = null;
    
    #[ORM\OneToMany(targetEntity:"Plat", mappedBy:"unResto")]
    private ?Collection $lesPlats;
    
    #[ORM\ManyToOne(targetEntity:"User", inversedBy:"lesRestos")]
    private ?User $unUser;
    
    #[ORM\OneToMany(targetEntity:"Evaluation", mappedBy:"unResto")]
    private ?Collection $lesEvaluations;
    
    public function __construct() {
        $this->lesPlats = new ArrayCollection();
        $this->lesUsers = new ArrayCollection();
    }

        public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomR(): ?string
    {
        return $this->nomR;
    }

    public function setNomR(?string $nomR): static
    {
        $this->nomR = $nomR;

        return $this;
    }

    public function getNumAdrR(): ?string
    {
        return $this->numAdrR;
    }

    public function setNumAdrR(?string $numAdrR): static
    {
        $this->numAdrR = $numAdrR;

        return $this;
    }

    public function getRueAdrR(): ?string
    {
        return $this->rueAdrR;
    }

    public function setRueAdrR(?string $rueAdrR): static
    {
        $this->rueAdrR = $rueAdrR;

        return $this;
    }

    public function getCpR(): ?string
    {
        return $this->cpR;
    }

    public function setCpR(?string $cpR): static
    {
        $this->cpR = $cpR;

        return $this;
    }

    public function getVilleR(): ?string
    {
        return $this->villeR;
    }

    public function setVilleR(?string $villeR): static
    {
        $this->villeR = $villeR;

        return $this;
    }

    public function getHorairesR(): ?string
    {
        return $this->horairesR;
    }

    public function setHorairesR(?string $horairesR): static
    {
        $this->horairesR = $horairesR;

        return $this;
    }
    
    public function getLesPlats(): ?Collection {
        return $this->lesPlats;
    }

    public function getUnUser(): ?User {
        return $this->unUser;
    }

    public function getLesEvaluations(): ?Collection {
        return $this->lesEvaluations;
    }

    public function setLesPlats(?Collection $lesPlats): void {
        $this->lesPlats = $lesPlats;
    }

    public function setUnUser(?User $unUser): void {
        $this->unUser = $unUser;
    }

    public function setLesEvaluations(?Collection $lesEvaluations): void {
        $this->lesEvaluations = $lesEvaluations;
    }
 
    public function __toString() {
        return $this->nomR;
    }


    
}
