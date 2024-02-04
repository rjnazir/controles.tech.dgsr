<?php

namespace App\Entity;

use App\Repository\CtReceptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtReceptionRepository::class)
 */
class CtReception
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtCentre::class, inversedBy="ctReceptions")
     */
    private $ctCentre;

    /**
     * @ORM\ManyToOne(targetEntity=CtMotif::class, inversedBy="ctReceptions")
     */
    private $ctMotif;

    /**
     * @ORM\ManyToOne(targetEntity=CtTypeReception::class, inversedBy="ctReceptions")
     */
    private $ctTypeReception;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctReceptions")
     */
    private $ctUser;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctReceptions")
     */
    private $ctVerificateur;

    /**
     * @ORM\ManyToOne(targetEntity=CtUtilisation::class, inversedBy="ctReceptions")
     */
    private $ctUtilisation;

    /**
     * @ORM\ManyToOne(targetEntity=CtVehicule::class, inversedBy="ctReceptions")
     */
    private $ctVehicule;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $rcpMiseService;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $rcpImmatriculation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rcpProprietaire;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rcpProfession;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rcpAdresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rcpNbrAssis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rcpNbrDebout;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rcpNumPv;

    /**
     * @ORM\ManyToOne(targetEntity=CtSourceEnergie::class, inversedBy="ctReceptions")
     */
    private $ctSourceEnergie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rcpNumGroup;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rcpObsDel;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rcpCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rcpUpdate;

    /**
     * @ORM\ManyToOne(targetEntity=CtCarrosserie::class, inversedBy="ctReceptions")
     */
    private $ctCarrosserie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtCentre(): ?CtCentre
    {
        return $this->ctCentre;
    }

    public function setCtCentre(?CtCentre $ctCentre): self
    {
        $this->ctCentre = $ctCentre;

        return $this;
    }

    public function getCtMotif(): ?CtMotif
    {
        return $this->ctMotif;
    }

    public function setCtMotif(?CtMotif $ctMotif): self
    {
        $this->ctMotif = $ctMotif;

        return $this;
    }

    public function getCtTypeReception(): ?CtTypeReception
    {
        return $this->ctTypeReception;
    }

    public function setCtTypeReception(?CtTypeReception $ctTypeReception): self
    {
        $this->ctTypeReception = $ctTypeReception;

        return $this;
    }

    public function getCtUser(): ?User
    {
        return $this->ctUser;
    }

    public function setCtUser(?User $ctUser): self
    {
        $this->ctUser = $ctUser;

        return $this;
    }

    public function getCtVerificateur(): ?User
    {
        return $this->ctVerificateur;
    }

    public function setCtVerificateur(?User $ctVerificateur): self
    {
        $this->ctVerificateur = $ctVerificateur;

        return $this;
    }

    public function getCtUtilisation(): ?CtUtilisation
    {
        return $this->ctUtilisation;
    }

    public function setCtUtilisation(?CtUtilisation $ctUtilisation): self
    {
        $this->ctUtilisation = $ctUtilisation;

        return $this;
    }

    public function getCtVehicule(): ?CtVehicule
    {
        return $this->ctVehicule;
    }

    public function setCtVehicule(?CtVehicule $ctVehicule): self
    {
        $this->ctVehicule = $ctVehicule;

        return $this;
    }

    public function getRcpMiseService(): ?\DateTimeInterface
    {
        return $this->rcpMiseService;
    }

    public function setRcpMiseService(?\DateTimeInterface $rcpMiseService): self
    {
        $this->rcpMiseService = $rcpMiseService;

        return $this;
    }

    public function getRcpImmatriculation(): ?string
    {
        return $this->rcpImmatriculation;
    }

    public function setRcpImmatriculation(string $rcpImmatriculation): self
    {
        $this->rcpImmatriculation = $rcpImmatriculation;

        return $this;
    }

    public function getRcpProprietaire(): ?string
    {
        return $this->rcpProprietaire;
    }

    public function setRcpProprietaire(string $rcpProprietaire): self
    {
        $this->rcpProprietaire = $rcpProprietaire;

        return $this;
    }

    public function getRcpProfession(): ?string
    {
        return $this->rcpProfession;
    }

    public function setRcpProfession(string $rcpProfession): self
    {
        $this->rcpProfession = $rcpProfession;

        return $this;
    }

    public function getRcpAdresse(): ?string
    {
        return $this->rcpAdresse;
    }

    public function setRcpAdresse(?string $rcpAdresse): self
    {
        $this->rcpAdresse = $rcpAdresse;

        return $this;
    }

    public function getRcpNbrAssis(): ?int
    {
        return $this->rcpNbrAssis;
    }

    public function setRcpNbrAssis(?int $rcpNbrAssis): self
    {
        $this->rcpNbrAssis = $rcpNbrAssis;

        return $this;
    }

    public function getRcpNbrDebout(): ?int
    {
        return $this->rcpNbrDebout;
    }

    public function setRcpNbrDebout(?int $rcpNbrDebout): self
    {
        $this->rcpNbrDebout = $rcpNbrDebout;

        return $this;
    }

    public function getRcpNumPv(): ?string
    {
        return $this->rcpNumPv;
    }

    public function setRcpNumPv(?string $rcpNumPv): self
    {
        $this->rcpNumPv = $rcpNumPv;

        return $this;
    }

    public function getCtSourceEnergie(): ?CtSourceEnergie
    {
        return $this->ctSourceEnergie;
    }

    public function setCtSourceEnergie(?CtSourceEnergie $ctSourceEnergie): self
    {
        $this->ctSourceEnergie = $ctSourceEnergie;

        return $this;
    }

    public function getRcpNumGroup(): ?string
    {
        return $this->rcpNumGroup;
    }

    public function setRcpNumGroup(?string $rcpNumGroup): self
    {
        $this->rcpNumGroup = $rcpNumGroup;

        return $this;
    }

    public function isIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getRcpObsDel(): ?string
    {
        return $this->rcpObsDel;
    }

    public function setRcpObsDel(?string $rcpObsDel): self
    {
        $this->rcpObsDel = $rcpObsDel;

        return $this;
    }

    public function getRcpCreated(): ?\DateTimeInterface
    {
        return $this->rcpCreated;
    }

    public function setRcpCreated(?\DateTimeInterface $rcpCreated): self
    {
        $this->rcpCreated = $rcpCreated;

        return $this;
    }

    public function getRcpUpdate(): ?\DateTimeInterface
    {
        return $this->rcpUpdate;
    }

    public function setRcpUpdate(?\DateTimeInterface $rcpUpdate): self
    {
        $this->rcpUpdate = $rcpUpdate;

        return $this;
    }

    public function getCtCarrosserie(): ?CtCarrosserie
    {
        return $this->ctCarrosserie;
    }

    public function setCtCarrosserie(?CtCarrosserie $ctCarrosserie): self
    {
        $this->ctCarrosserie = $ctCarrosserie;

        return $this;
    }
}
