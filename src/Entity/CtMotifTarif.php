<?php

namespace App\Entity;

use App\Repository\CtMotifTarifRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtMotifTarifRepository::class)
 * @ORM\Table(name="ct_motif_tarif", uniqueConstraints={@ORM\UniqueConstraint(columns={"ct_arrete_prix_id", "ct_motif_id", "mtf_trf_date"})})
 * @UniqueEntity(
 *  fields={"ctArretePrix", "ctMotif", "mtfTrfDate"},
 *  errorPath="ctArretePrix",
 *  message="Le tarif du motif entré est déjà existant.")
 * @ORM\Entity(repositoryClass=CtMotifTarifRepository::class)
 * @ORM\Entity
 */
class CtMotifTarif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mtfTrfPrix;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $mtfTrfDate;

    /**
     * @ORM\ManyToOne(targetEntity=CtMotif::class, inversedBy="ctMotifTarifs")
     */
    private $ctMotif;

    /**
     * @ORM\ManyToOne(targetEntity=CtArretePrix::class, inversedBy="ctMotifTarifs")
     */
    private $ctArretePrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMtfTrfPrix(): ?float
    {
        return $this->mtfTrfPrix;
    }

    public function setMtfTrfPrix(?float $mtfTrfPrix): self
    {
        $this->mtfTrfPrix = $mtfTrfPrix;

        return $this;
    }

    public function getMtfTrfDate(): ?string
    {
        return $this->mtfTrfDate;
    }

    public function setMtfTrfDate(?string $mtfTrfDate): self
    {
        $this->mtfTrfDate = $mtfTrfDate;

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
