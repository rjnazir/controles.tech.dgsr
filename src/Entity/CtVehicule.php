<?php

namespace App\Entity;

use App\Repository\CtVehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtVehiculeRepository::class)
 */
class CtVehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $vhcCylindre;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcPuissance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcPoidsVide;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcChargeUtile;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcHauteur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcLargeur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcLongueur;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $vhcNumSerie;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $vhcNumMoteur;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $vhcProvenance;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $vhcType;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vhcPoidsTotalCharge;

    /**
     * @ORM\ManyToOne(targetEntity=CtGenre::class, inversedBy="ctVehicules")
     */
    private $ctGenre;

    /**
     * @ORM\ManyToOne(targetEntity=CtMarque::class, inversedBy="ctVehicules")
     */
    private $ctMarque;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $vhcCreated;

    /**
     * @ORM\OneToMany(targetEntity=CtReception::class, mappedBy="ctVehicule")
     */
    private $ctReceptions;

    public function __construct()
    {
        $this->ctMarque = new ArrayCollection();
        $this->ctReceptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVhcCylindre(): ?string
    {
        return $this->vhcCylindre;
    }

    public function setVhcCylindre(?string $vhcCylindre): self
    {
        $this->vhcCylindre = $vhcCylindre;

        return $this;
    }

    public function getVhcPuissance(): ?float
    {
        return $this->vhcPuissance;
    }

    public function setVhcPuissance(?float $vhcPuissance): self
    {
        $this->vhcPuissance = $vhcPuissance;

        return $this;
    }

    public function getVhcPoidsVide(): ?float
    {
        return $this->vhcPoidsVide;
    }

    public function setVhcPoidsVide(?float $vhcPoidsVide): self
    {
        $this->vhcPoidsVide = $vhcPoidsVide;

        return $this;
    }

    public function getVhcChargeUtile(): ?float
    {
        return $this->vhcChargeUtile;
    }

    public function setVhcChargeUtile(?float $vhcChargeUtile): self
    {
        $this->vhcChargeUtile = $vhcChargeUtile;

        return $this;
    }

    public function getVhcHauteur(): ?float
    {
        return $this->vhcHauteur;
    }

    public function setVhcHauteur(?float $vhcHauteur): self
    {
        $this->vhcHauteur = $vhcHauteur;

        return $this;
    }

    public function getVhcLargeur(): ?float
    {
        return $this->vhcLargeur;
    }

    public function setVhcLargeur(?float $vhcLargeur): self
    {
        $this->vhcLargeur = $vhcLargeur;

        return $this;
    }

    public function getVhcLongueur(): ?float
    {
        return $this->vhcLongueur;
    }

    public function setVhcLongueur(?float $vhcLongueur): self
    {
        $this->vhcLongueur = $vhcLongueur;

        return $this;
    }

    public function getVhcNumSerie(): ?string
    {
        return $this->vhcNumSerie;
    }

    public function setVhcNumSerie(?string $vhcNumSerie): self
    {
        $this->vhcNumSerie = $vhcNumSerie;

        return $this;
    }

    public function getVhcNumMoteur(): ?string
    {
        return $this->vhcNumMoteur;
    }

    public function setVhcNumMoteur(string $vhcNumMoteur): self
    {
        $this->vhcNumMoteur = $vhcNumMoteur;

        return $this;
    }

    public function getVhcProvenance(): ?string
    {
        return $this->vhcProvenance;
    }

    public function setVhcProvenance(?string $vhcProvenance): self
    {
        $this->vhcProvenance = $vhcProvenance;

        return $this;
    }

    public function getVhcType(): ?string
    {
        return $this->vhcType;
    }

    public function setVhcType(?string $vhcType): self
    {
        $this->vhcType = $vhcType;

        return $this;
    }

    public function getVhcPoidsTotalCharge(): ?float
    {
        return $this->vhcPoidsTotalCharge;
    }

    public function setVhcPoidsTotalCharge(?float $vhcPoidsTotalCharge): self
    {
        $this->vhcPoidsTotalCharge = $vhcPoidsTotalCharge;

        return $this;
    }

    public function getCtGenre(): ?CtGenre
    {
        return $this->ctGenre;
    }

    public function setCtGenre(?CtGenre $ctGenre): self
    {
        $this->ctGenre = $ctGenre;

        return $this;
    }

    public function getCtMarque(): ?CtMarque
    {
        return $this->ctMarque;
    }

    public function setCtMarque(?CtMarque $ctMarque): self
    {
        $this->ctMarque = $ctMarque;

        return $this;
    }

    public function getVhcCreated(): ?\DateTimeInterface
    {
        return $this->vhcCreated;
    }

    public function setVhcCreated(?\DateTimeInterface $vhcCreated): self
    {
        $this->vhcCreated = $vhcCreated;

        return $this;
    }

    /**
     * @return Collection<int, CtReception>
     */
    public function getCtReceptions(): Collection
    {
        return $this->ctReceptions;
    }

    public function addCtReception(CtReception $ctReception): self
    {
        if (!$this->ctReceptions->contains($ctReception)) {
            $this->ctReceptions[] = $ctReception;
            $ctReception->setCtVehicule($this);
        }

        return $this;
    }

    public function removeCtReception(CtReception $ctReception): self
    {
        if ($this->ctReceptions->removeElement($ctReception)) {
            // set the owning side to null (unless already changed)
            if ($ctReception->getCtVehicule() === $this) {
                $ctReception->setCtVehicule(null);
            }
        }

        return $this;
    }

}
