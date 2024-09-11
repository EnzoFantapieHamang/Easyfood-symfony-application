<?php

namespace App\Entity;

use App\Repository\TypePlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"typeplat")]
class TypePlat {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;
    
    #[ORM\OneToMany(targetEntity:"Plat", mappedBy:"unTypePlat")]
    private ?Collection $lesPlats;
    
    public function __construct() {
        $this->lesPlats = new ArrayCollection();
    }

        public function getId(): ?int {
        return $this->id;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): static {
        $this->description = $description;

        return $this;
    }
    
    
    public function getLesPlats(): ?Collection {
        return $this->lesPlats;
    }

    public function setLesPlats(?Collection $lesPlats): void {
        $this->lesPlats = $lesPlats;
    }

    public function __toString() {
        return $this->description;
    }



    
    }
