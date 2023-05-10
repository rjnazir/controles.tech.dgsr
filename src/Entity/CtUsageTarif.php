<?php

namespace App\Entity;

use App\Repository\CtUsageTarifRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtUsageTarifRepository::class)
 * @UniqueEntity(
 *  fields={"usgTrfAnnee", "ctUsage", "ctTypeVisite"},
 *  message="Le tarif pour l'usage entrés est déjà existant"
 * )
 */
class CtUsageTarif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $usgTrfAnnee;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $usgTrfPrix;

    /**
     * @ORM\ManyToOne(targetEntity=CtUsage::class, inversedBy="ctUsageTarifs")
     */
    private $ctUsage;

    /**
     * @ORM\ManyToOne(targetEntity=CtTypeVisite::class, inversedBy="ctUsageTarifs")
     */
    private $ctTypeVisite;

    /**
     * @ORM\ManyToOne(targetEntity=CtArretePrix::class, inversedBy="ctUsageTarifs")
     */
    private $ctArretePrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsgTrfAnnee(): ?string
    {
        return $this->usgTrfAnnee;
    }

    public function setUsgTrfAnnee(?string $usgTrfAnnee): self
    {
        $this->usgTrfAnnee = $usgTrfAnnee;

        return $this;
    }

    public function getUsgTrfPrix(): ?float
    {
        return $this->usgTrfPrix;
    }

    public function setUsgTrfPrix(?float $usgTrfPrix): self
    {
        $this->usgTrfPrix = $usgTrfPrix;

        return $this;
    }

    public function getCtUsage(): ?CtUsage
    {
        return $this->ctUsage;
    }

    public function setCtUsage(?CtUsage $ctUsage): self
    {
        $this->ctUsage = $ctUsage;

        return $this;
    }

    public function getCtTypeVisite(): ?CtTypeVisite
    {
        return $this->ctTypeVisite;
    }

    public function setCtTypeVisite(?CtTypeVisite $ctTypeVisite): self
    {
        $this->ctTypeVisite = $ctTypeVisite;

        return $this;
    }

    public function getCtArretePrix(): ?CtArretePrix
    {
        return $this->ctArretePrix;
    }

    public function setCtArretePrix(?CtArretePrix $ctArretePrix): self
    {
        $this->ctArretePrix = $ctArretePrix;

        return $this;
    }
}
