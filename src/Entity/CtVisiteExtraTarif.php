<?php

namespace App\Entity;

use App\Repository\CtVisiteExtraTarifRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtVisiteExtraTarifRepository::class)
 * @ORM\Table(
 *  name = "ct_visite_extra_tarif",
 *      uniqueConstraints = {
 *          @ORM\UniqueConstraint(columns = {
 *              "ct_arrete_prix_id",
 *              "ct_visite_extra_id"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {
 *      "ctArretePrix",
 *      "ctVisiteExtra"
 *  },
 *  errorPath = "ctVisiteExtra",
 *  message = "Le tarif de {{ label }} entré est déjà existant."
 * )
 */
class CtVisiteExtraTarif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtArretePrix::class, inversedBy="ctVisiteExtraTarifs")
     */
    private $ctArretePrix;

    /**
     * @ORM\ManyToOne(targetEntity=CtVisiteExtra::class, inversedBy="ctVisiteExtraTarifs")
     */
    private $ctVisiteExtra;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $vetAnnee;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vetPrix;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCtVisiteExtra(): ?CtVisiteExtra
    {
        return $this->ctVisiteExtra;
    }

    public function setCtVisiteExtra(?CtVisiteExtra $ctVisiteExtra): self
    {
        $this->ctVisiteExtra = $ctVisiteExtra;

        return $this;
    }

    public function getVetAnnee(): ?string
    {
        return $this->vetAnnee;
    }

    public function setVetAnnee(?string $vetAnnee): self
    {
        $this->vetAnnee = $vetAnnee;

        return $this;
    }

    public function getVetPrix(): ?float
    {
        return $this->vetPrix;
    }

    public function setVetPrix(?float $vetPrix): self
    {
        $this->vetPrix = $vetPrix;

        return $this;
    }
}
