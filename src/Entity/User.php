<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank()]
    private ?string $prenom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 2, max: 50)]
    #[Assert\NotBlank()]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Projet::class)]
    private Collection $projet;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Actualite::class)]
    private Collection $actualite;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Temoignage $temoignage = null;

    public function __construct()
    {
        $this->projet = new ArrayCollection();
        $this->actualite = new ArrayCollection();
        $this->roles = ['ROLE_USER']; // Ajout du rôle "ROLE_USER" par défaut
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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
        return $this->roles;
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjet(): Collection
    {
        return $this->projet;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projet->contains($projet)) {
            $this->projet->add($projet);
            $projet->setUser($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        if ($this->projet->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getUser() === $this) {
                $projet->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Actualite>
     */
    public function getactualite(): Collection
    {
        return $this->actualite;
    }

    public function addactualite(Actualite $actualite): self
    {
        if (!$this->actualite->contains($actualite)) {
            $this->actualite->add($actualite);
            $actualite->setUser($this);
        }

        return $this;
    }

    public function removeactualite(Actualite $actualite): self
    {
        if ($this->actualite->removeElement($actualite)) {
            // set the owning side to null (unless already changed)
            if ($actualite->getUser() === $this) {
                $actualite->setUser(null);
            }
        }

        return $this;
    }

    public function getTemoignage(): ?Temoignage
    {
        return $this->temoignage;
    }

    public function setTemoignage(?Temoignage $temoignage): self
    {
        // unset the owning side of the relation if necessary
        if ($temoignage === null && $this->temoignage !== null) {
            $this->temoignage->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($temoignage !== null && $temoignage->getUser() !== $this) {
            $temoignage->setUser($this);
        }

        $this->temoignage = $temoignage;

        return $this;
    }
}
