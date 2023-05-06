<?php

namespace App\Entity;

use App\Repository\CtMotifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtMotifRepository::class)
 * @UniqueEntity(fields="mtfLibelle", message="Le libellé entré est déjà existant")
 */
class CtMotif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $mtfLibelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mtfIsCalculable;

    /**
     * @ORM\OneToMany(targetEntity=CtMotifTarif::class, mappedBy="ctMotif")
     */
    private $ctMotifTarifs;

    public function __construct()
    {
        $this->ctMotifTarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMtfLibelle(): ?string
    {
        return $this->mtfLibelle;
    }

    public function setMtfLibelle(?string $mtfLibelle): self
    {
        $this->mtfLibelle = $mtfLibelle;

        return $this;
    }

    public function isMtfIsCalculable(): ?bool
    {
        return $this->mtfIsCalculable;
    }

    public function setMtfIsCalculable(bool $mtfIsCalculable): self
    {
        $this->mtfIsCalculable = $mtfIsCalculable;

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
            $ctMotifTarif->setCtMotif($this);
        }

        return $this;
    }

    public function removeCtMotifTarif(CtMotifTarif $ctMotifTarif): self
    {
        if ($this->ctMotifTarifs->removeElement($ctMotifTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctMotifTarif->getCtMotif() === $this) {
                $ctMotifTarif->setCtMotif(null);
            }
        }

        return $this;
    }
}
