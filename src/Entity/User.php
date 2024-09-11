<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numAdrR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rueAdrR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cpR = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $villeR = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $commentaireVisible = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaireEasyFood = null;
    
    #[ORM\Column(nullable: true)]
    private ?float $noteEasyFood = null;
    
    #[ORM\ManyToOne(targetEntity:"TypeUser", inversedBy:"lesUsers")]
    private ?TypeUser $unTypeUser;
    
    #[ORM\OneToMany(targetEntity:"Commande", mappedBy:"unUser")]
    private ?Collection $lesCommandes;
    
    #[ORM\OneToMany(targetEntity:"Resto", mappedBy:"unUser")]
    private ?Collection $lesRestos;
    
    #[ORM\OneToMany(targetEntity:"Evaluation", mappedBy:"unUser")]
    private ?Collection $lesEvaluations;
    
    public function __construct() {
        $this->commentaireVisible = false;
        $this->lesCommandes = new ArrayCollection();
        $this->lesRestos = new ArrayCollection();
        $this->lesEvaluations = new ArrayCollection();
    }

    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
    
    public function getNumAdrR(): ?string {
        return $this->numAdrR;
    }

    public function getRueAdrR(): ?string {
        return $this->rueAdrR;
    }

    public function getCpR(): ?string {
        return $this->cpR;
    }

    public function getVilleR(): ?string {
        return $this->villeR;
    }

    public function getCommentaireVisible(): ?bool {
        return $this->commentaireVisible;
    }

    public function getCommentaireEasyFood(): ?string {
        return $this->commentaireEasyFood;
    }

    public function getNoteEasyFood(): ?float {
        return $this->noteEasyFood;
    }

    public function getUnTypeUser(): ?TypeUser {
        return $this->unTypeUser;
    }

    public function getLesCommandes(): ?Collection {
        return $this->lesCommandes;
    }

    public function getLesRestos(): ?Collection {
        return $this->lesRestos;
    }

    public function getLesEvaluations(): ?Collection {
        return $this->lesEvaluations;
    }

    public function setNumAdrR(?string $numAdrR): void {
        $this->numAdrR = $numAdrR;
    }

    public function setRueAdrR(?string $rueAdrR): void {
        $this->rueAdrR = $rueAdrR;
    }

    public function setCpR(?string $cpR): void {
        $this->cpR = $cpR;
    }

    public function setVilleR(?string $villeR): void {
        $this->villeR = $villeR;
    }

    public function setCommentaireVisible(?bool $commentaireVisible): void {
        $this->commentaireVisible = $commentaireVisible;
    }

    public function setCommentaireEasyFood(?string $commentaireEasyFood): void {
        $this->commentaireEasyFood = $commentaireEasyFood;
    }

    public function setNoteEasyFood(?float $noteEasyFood): void {
        $this->noteEasyFood = $noteEasyFood;
    }

    public function setUnTypeUser(?TypeUser $unTypeUser): void {
        $this->unTypeUser = $unTypeUser;
    }

    public function setLesCommandes(?Collection $lesCommandes): void {
        $this->lesCommandes = $lesCommandes;
    }

    public function setLesRestos(?Collection $lesRestos): void {
        $this->lesRestos = $lesRestos;
    }

    public function setLesEvaluations(?Collection $lesEvaluations): void {
        $this->lesEvaluations = $lesEvaluations;
    }

    
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    public function serialize()
    {
        return serialize([
            $this->id,
            // other properties to serialize
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            // other properties to unserialize
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }
    
    public function __toString(): string {
    return (string) $this->id;
}
}
