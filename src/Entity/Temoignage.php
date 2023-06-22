<?php

namespace App\Entity;

use App\Repository\TemoignageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Entity\File;

#[ORM\Entity(repositoryClass: TemoignageRepository::class)]
class Temoignage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $temoignage = null;

    #[Vich\UploadableField(mapping: 'temoignages_images', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToOne(inversedBy: 'temoignage', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemoignage(): ?string
    {
        return $this->temoignage;
    }

    public function setTemoignage(string $temoignage): self
    {
        $this->temoignage = $temoignage;

        return $this;
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if ($imageFile !== null) {
            $this->date = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
