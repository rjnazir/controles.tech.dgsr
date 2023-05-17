<?php

namespace App\Entity;

use App\Repository\CtProcesVerbalRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtProcesVerbalRepository::class)
 * @ORM\Table(
 *  name = "ct_proces_verbal",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_arrete_prix_id", "pv_type"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctArretePrix", "pvType"},
 *  errorPath = "pvType",
 *  message = "Le tarif de ce type de procès-verbal entré est déjà existant.")
 */
class CtProcesVerbal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtArretePrix::class, inversedBy="ctProcesVerbals")
     */
    private $ctArretePrix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pvType;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pvTarif;

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

    public function getPvType(): ?string
    {
        return $this->pvType;
    }

    public function setPvType(?string $pvType): self
    {
        $this->pvType = $pvType;

        return $this;
    }

    public function getPvTarif(): ?float
    {
        return $this->pvTarif;
    }

    public function setPvTarif(?float $pvTarif): self
    {
        $this->pvTarif = $pvTarif;

        return $this;
    }
}
