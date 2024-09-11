<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"evaluation")]
class Evaluation {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column]
    private ?string $user;

    #[ORM\Column(nullable: true)]
    private ?float $qualiteNouritureE = null;

    #[ORM\Column(nullable: true)]
    private ?float $respectRecetteE = null;

    #[ORM\Column(nullable: true)]
    private ?float $coutNoteE = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaireClient = null;

    #[ORM\Column(nullable: true)]
    private ?bool $commentaireVisibleE = null;

    #[ORM\ManyToOne(targetEntity: "Resto", inversedBy: "lesEvaluations")]
    private ?Resto $lesRestos;

    #[ORM\ManyToOne(targetEntity: "User", inversedBy: "lesEvaluations")]
    private ?User $unUser;

    
    
    

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    
    
    public function getId(): ?int {
        return $this->id;
    }

    public function getQualiteNouritureE(): ?float {
        return $this->qualiteNouritureE;
    }

    public function setQualiteNouritureE(?float $qualiteNouritureE): static {
        $this->qualiteNouritureE = $qualiteNouritureE;

        return $this;
    }

    public function getRespectRecetteE(): ?float {
        return $this->respectRecetteE;
    }

    public function setRespectRecetteE(?float $respectRecetteE): static {
        $this->respectRecetteE = $respectRecetteE;

        return $this;
    }


    public function getCoutNoteE(): ?float {
        return $this->coutNoteE;
    }

    public function setCoutNoteE(?float $coutNoteE): static {
        $this->coutNoteE = $coutNoteE;

        return $this;
    }

    public function getCommentaireClient(): ?string {
        return $this->commentaireClient;
    }

    public function setCommentaireClient(?string $commentaireClient): static {
        $this->commentaireClient = $commentaireClient;

        return $this;
    }

    public function isCommentaireVisibleE(): ?bool {
        return $this->commentaireVisibleE;
    }

    public function setCommentaireVisibleE(?bool $commentaireVisibleE): static {
        $this->commentaireVisibleE = $commentaireVisibleE;

        return $this;
    }

    public function getLesRestos(): ?Resto {
        return $this->lesRestos;
    }

    public function setLesRestos(?Resto $lesRestos): void {
        $this->lesRestos = $lesRestos;
    }

    public function getUnUser(): ?User {
        return $this->unUser;
    }

    public function setUnUser(?User $unUser): void {
        $this->unUser = $unUser;
    }
    
    public function __toString() {
        return $this->getCoutNoteE();
    }

    
    
}
