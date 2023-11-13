<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Url = null;

    #[ORM\Column(length: 255)]
    private ?string $Caption = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ad $Ad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->Url;
    }

    public function setUrl(string $Url): static
    {
        $this->Url = $Url;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->Caption;
    }

    public function setCaption(string $Caption): static
    {
        $this->Caption = $Caption;

        return $this;
    }

    public function getAd(): ?Ad
    {
        return $this->Ad;
    }

    public function setAd(?Ad $Ad): static
    {
        $this->Ad = $Ad;

        return $this;
    }
}
