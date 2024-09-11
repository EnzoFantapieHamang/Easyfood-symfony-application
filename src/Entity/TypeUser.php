<?php

namespace App\Entity;

use App\Repository\TypeUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'TypeUser')]
class TypeUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;
    
    
    #[ORM\OneToMany(targetEntity:"User", mappedBy:"unTypeUser")]
    private ?Collection $lesUser;
    
    public function __construct() {
        $this->lesUser = new ArrayCollection();
    }

        public function getId(): ?int
    {
        return $this->id;
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
    

    
    public function getLesUser(): ?Collection {
        return $this->lesUser;
    }

    public function setLesUser(?Collection $lesUser): void {
        $this->lesUser = $lesUser;
    }
    
    
    public function __toString(): string {
        return "TypeUser[id=" . $this->id
                . ", description=" . $this->description
                . "]";
    }

 
    
    
}
