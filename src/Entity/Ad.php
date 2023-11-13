<?php

namespace App\Entity;

use App\Repository\AdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdRepository::class)]
class Ad
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brand = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $MainImg = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $km = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 2, scale: '0')]
    private ?string $PrevOwners = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $Engine = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: '0')]
    private ?string $Power = null;

    #[ORM\Column(length: 255)]
    private ?string $Fuel = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: '0')]
    private ?string $FirstRelease = null;

    #[ORM\Column(length: 255)]
    private ?string $Transmission = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Options = null;

    #[ORM\OneToMany(mappedBy: 'Ad', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $images;

    /**
     * Permet d'intialiser le slug automatiquement si on ne le donne pas.
     */
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function initializeSlug(): void
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->title);
        }
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getMainImg(): ?string
    {
        return $this->MainImg;
    }

    public function setMainImg(string $MainImg): static
    {
        $this->model = $MainImg;

        return $this;
    }

    public function getKm(): ?string
    {
        return $this->km;
    }

    public function setKm(string $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPrevOwners(): ?string
    {
        return $this->PrevOwners;
    }

    public function setPrevOwners(string $PrevOwners): static
    {
        $this->PrevOwners = $PrevOwners;

        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->Engine;
    }

    public function setEngine(string $Engine): static
    {
        $this->Engine = $Engine;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->Power;
    }

    public function setPower(string $Power): static
    {
        $this->Power = $Power;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->Fuel;
    }

    public function setFuel(string $Fuel): static
    {
        $this->Fuel = $Fuel;

        return $this;
    }

    public function getFirstRelease(): ?string
    {
        return $this->FirstRelease;
    }

    public function setFirstRelease(string $FirstRelease): static
    {
        $this->FirstRelease = $FirstRelease;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->Transmission;
    }

    public function setTransmission(string $Transmission): static
    {
        $this->Transmission = $Transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->Options;
    }

    public function setOptions(?string $Options): static
    {
        $this->Options = $Options;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setAd($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAd() === $this) {
                $image->setAd(null);
            }
        }

        return $this;
    }
}
