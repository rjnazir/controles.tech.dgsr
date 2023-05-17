<?php

namespace App\Entity;

use App\Repository\CtGenreCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtGenreCategorieRepository::class)
 * @UniqueEntity(fields="gcLibelle", message="Le libellé entré est déjà existant")
 */
class CtGenreCategorie
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
    private $gcLibelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gcIsCalculable;

    /**
     * @ORM\OneToMany(targetEntity=CtGenre::class, mappedBy="ctGenreCategorie")
     */
    private $ctGenres;

    /**
     * @ORM\OneToMany(targetEntity=CtDroitPtac::class, mappedBy="ctGenreCategorie")
     */
    private $ctDroitPtacs;

    public function __construct()
    {
        $this->ctGenres = new ArrayCollection();
        $this->ctDroitPtacs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGcLibelle(): ?string
    {
        return $this->gcLibelle;
    }

    public function setGcLibelle(?string $gcLibelle): self
    {
        $this->gcLibelle = $gcLibelle;

        return $this;
    }

    public function isGcIsCalculable(): ?bool
    {
        return $this->gcIsCalculable;
    }

    public function setGcIsCalculable(bool $gcIsCalculable): self
    {
        $this->gcIsCalculable = $gcIsCalculable;

        return $this;
    }

    /**
     * @return Collection<int, CtGenre>
     */
    public function getCtGenres(): Collection
    {
        return $this->ctGenres;
    }

    public function addCtGenre(CtGenre $ctGenre): self
    {
        if (!$this->ctGenres->contains($ctGenre)) {
            $this->ctGenres[] = $ctGenre;
            $ctGenre->setCtGenreCategorie($this);
        }

        return $this;
    }

    public function removeCtGenre(CtGenre $ctGenre): self
    {
        if ($this->ctGenres->removeElement($ctGenre)) {
            // set the owning side to null (unless already changed)
            if ($ctGenre->getCtGenreCategorie() === $this) {
                $ctGenre->setCtGenreCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CtDroitPtac>
     */
    public function getCtDroitPtacs(): Collection
    {
        return $this->ctDroitPtacs;
    }

    public function addCtDroitPtac(CtDroitPtac $ctDroitPtac): self
    {
        if (!$this->ctDroitPtacs->contains($ctDroitPtac)) {
            $this->ctDroitPtacs[] = $ctDroitPtac;
            $ctDroitPtac->setCtGenreCategorie($this);
        }

        return $this;
    }

    public function removeCtDroitPtac(CtDroitPtac $ctDroitPtac): self
    {
        if ($this->ctDroitPtacs->removeElement($ctDroitPtac)) {
            // set the owning side to null (unless already changed)
            if ($ctDroitPtac->getCtGenreCategorie() === $this) {
                $ctDroitPtac->setCtGenreCategorie(null);
            }
        }

        return $this;
    }
}
