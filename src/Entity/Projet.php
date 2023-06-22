<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File;

#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 2, max: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Url()]
    private ?string $lien = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $difficultes = null;

    #[Vich\UploadableField(mapping: 'projets_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'projets')]
    #[ORM\JoinTable(name: 'categorie_projet')]
    private Collection $categorie;

    #[ORM\ManyToOne(inversedBy: 'projet')]
    private ?User $user = null;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getDifficultes(): ?string
    {
        return $this->difficultes;
    }

    public function setDifficultes(?string $difficultes): self
    {
        $this->difficultes = $difficultes;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageName($image)
    {
        $this->imageName = $image;
    }

    public function getImageName()
    {
        return $this->imageName;
    }
    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }


    public function removeCategorie(Categorie $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
            $categorie->removeProjet($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
