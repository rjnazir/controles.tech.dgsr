<?php

namespace App\Entity;

use App\Repository\CtArretePrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtArretePrixRepository::class)
 * @UniqueEntity(fields="art_numero", message="Le numéro de l'arrêté entré est déjà existant")
 */
class CtArretePrix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=124, unique=true)
     */
    private $art_numero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $art_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $art_date_applic;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $art_created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $art_updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctArretePrixes")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CtMotifTarif::class, mappedBy="ctArretePrix")
     */
    private $ctMotifTarifs;

    /**
     * @ORM\OneToMany(targetEntity=CtUsageTarif::class, mappedBy="ctArretePrix")
     */
    private $ctUsageTarifs;

    public function __construct()
    {
        $this->ctMotifTarifs = new ArrayCollection();
        $this->ctUsageTarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtNumero(): ?string
    {
        return $this->art_numero;
    }

    public function setArtNumero(string $art_numero): self
    {
        $this->art_numero = $art_numero;

        return $this;
    }

    public function getArtDate(): ?\DateTimeInterface
    {
        return $this->art_date;
    }

    public function setArtDate(?\DateTimeInterface $art_date): self
    {
        $this->art_date = $art_date;

        return $this;
    }

    public function getArtDateApplic(): ?\DateTimeInterface
    {
        return $this->art_date_applic;
    }

    public function setArtDateApplic(?\DateTimeInterface $art_date_applic): self
    {
        $this->art_date_applic = $art_date_applic;

        return $this;
    }

    public function getArtCreatedAt(): ?\DateTimeImmutable
    {
        return $this->art_created_at;
    }

    public function setArtCreatedAt(?\DateTimeImmutable $art_created_at): self
    {
        $this->art_created_at = $art_created_at;

        return $this;
    }

    public function getArtUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->art_updated_at;
    }

    public function setArtUpdatedAt(?\DateTimeImmutable $art_updated_at): self
    {
        $this->art_updated_at = $art_updated_at;

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

    /**
     * @return Collection<int, CtMotifTarif>
     */
    public function getCtMotifTarifs(): Collection
    {
        return $this->ctMotifTarifs;
    }

    public function addCtMotifTarif(CtMotifTarif $ctMotifTarif): self
    {
        if (!$this->ctMotifTarifs->contains($ctMotifTarif)) {
            $this->ctMotifTarifs[] = $ctMotifTarif;
            $ctMotifTarif->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtMotifTarif(CtMotifTarif $ctMotifTarif): self
    {
        if ($this->ctMotifTarifs->removeElement($ctMotifTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctMotifTarif->getCtArretePrix() === $this) {
                $ctMotifTarif->setCtArretePrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CtUsageTarif>
     */
    public function getCtUsageTarifs(): Collection
    {
        return $this->ctUsageTarifs;
    }

    public function addCtUsageTarif(CtUsageTarif $ctUsageTarif): self
    {
        if (!$this->ctUsageTarifs->contains($ctUsageTarif)) {
            $this->ctUsageTarifs[] = $ctUsageTarif;
            $ctUsageTarif->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtUsageTarif(CtUsageTarif $ctUsageTarif): self
    {
        if ($this->ctUsageTarifs->removeElement($ctUsageTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctUsageTarif->getCtArretePrix() === $this) {
                $ctUsageTarif->setCtArretePrix(null);
            }
        }

        return $this;
    }
}
