<?php

namespace App\Entity;

use App\Repository\CtTarifAutreSceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtTarifAutreSceRepository::class)
 */
class CtTarifAutreSce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtTypeAutreSce::class, inversedBy="ctTarifAutreSces")
     */
    private $ctTypeAutreSce;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tasTarif;

    /**
     * @ORM\ManyToOne(targetEntity=CtArretePrix::class, inversedBy="ctTarifAutreSces")
     */
    private $ctArretePrix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtTypeAutreSce(): ?CtTypeAutreSce
    {
        return $this->ctTypeAutreSce;
    }

    public function setCtTypeAutreSce(?CtTypeAutreSce $ctTypeAutreSce): self
    {
        $this->ctTypeAutreSce = $ctTypeAutreSce;

        return $this;
    }

    public function getTasTarif(): ?float
    {
        return $this->tasTarif;
    }

    public function setTasTarif(?float $tasTarif): self
    {
        $this->tasTarif = $tasTarif;

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
