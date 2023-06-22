<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(max: 250)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Projet::class, mappedBy: 'categorie')]
    private Collection $projets;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->label;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): self
    {
        $this->projets->removeElement($projet);

        return $this;
    }
}
