<?php

namespace App\Entity;

use App\Repository\CtDroitPtacRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtDroitPtacRepository::class)
 * @ORM\Table(
 *  name = "ct_droit_ptac",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_arrete_prix_id", "ct_genre_categorie_id", "ct_type_droit_ptac_id", "dp_poids_min", "dp_poids_max"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctArretePrix", "ctGenreCategorie", "ctTypeDroitPtac", "dpPoidsMin", "dpPoidsMax"},
 *  errorPath = "dpDroit",
 *  message = "Le droit avec ces renseignements entré est déjà existant.")
 */
class CtDroitPtac
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtGenreCategorie::class, inversedBy="ctDroitPtacs")
     */
    private $ctGenreCategorie;

    /**
     * @ORM\ManyToOne(targetEntity=CtTypeDroitPtac::class, inversedBy="ctDroitPtacs")
     */
    private $ctTypeDroitPtac;

    /**
     * @ORM\ManyToOne(targetEntity=CtArretePrix::class, inversedBy="ctDroitPtacs")
     */
    private $ctArretePrix;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dpPoidsMin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dpPoidsMax;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $dpDroit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtGenreCategorie(): ?CtGenreCategorie
    {
        return $this->ctGenreCategorie;
    }

    public function setCtGenreCategorie(?CtGenreCategorie $ctGenreCategorie): self
    {
        $this->ctGenreCategorie = $ctGenreCategorie;

        return $this;
    }

    public function getCtTypeDroitPtac(): ?CtTypeDroitPtac
    {
        return $this->ctTypeDroitPtac;
    }

    public function setCtTypeDroitPtac(?CtTypeDroitPtac $ctTypeDroitPtac): self
    {
        $this->ctTypeDroitPtac = $ctTypeDroitPtac;

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

    public function getDpPoidsMin(): ?float
    {
        return $this->dpPoidsMin;
    }

    public function setDpPoidsMin(?float $dpPoidsMin): self
    {
        $this->dpPoidsMin = $dpPoidsMin;

        return $this;
    }

    public function getDpPoidsMax(): ?float
    {
        return $this->dpPoidsMax;
    }

    public function setDpPoidsMax(?float $dpPoidsMax): self
    {
        $this->dpPoidsMax = $dpPoidsMax;

        return $this;
    }

    public function getDpDroit(): ?float
    {
        return $this->dpDroit;
    }

    public function setDpDroit(?float $dpDroit): self
    {
        $this->dpDroit = $dpDroit;

        return $this;
    }
}
