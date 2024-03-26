<?php

namespace App\Entity;

use App\Repository\CtTypeAutreSceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtTypeAutreSceRepository::class)
 */
class CtTypeAutreSce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $tpasLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtTarifAutreSce::class, mappedBy="ctTypeAutreSce")
     */
    private $ctTarifAutreSces;

    /**
     * @ORM\OneToMany(targetEntity=CtAutreSce::class, mappedBy="ctTypeAutreSce")
     */
    private $ctAutreSces;

    public function __construct()
    {
        $this->ctTarifAutreSces = new ArrayCollection();
        $this->ctAutreSces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpasLibelle(): ?string
    {
        return $this->tpasLibelle;
    }

    public function setTpasLibelle(string $tpasLibelle): self
    {
        $this->tpasLibelle = $tpasLibelle;

        return $this;
    }

    /**
     * @return Collection<int, CtTarifAutreSce>
     */
    public function getCtTarifAutreSces(): Collection
    {
        return $this->ctTarifAutreSces;
    }

    public function addCtTarifAutreSce(CtTarifAutreSce $ctTarifAutreSce): self
    {
        if (!$this->ctTarifAutreSces->contains($ctTarifAutreSce)) {
            $this->ctTarifAutreSces[] = $ctTarifAutreSce;
            $ctTarifAutreSce->setCtTypeAutreSce($this);
        }

        return $this;
    }

    public function removeCtTarifAutreSce(CtTarifAutreSce $ctTarifAutreSce): self
    {
        if ($this->ctTarifAutreSces->removeElement($ctTarifAutreSce)) {
            // set the owning side to null (unless already changed)
            if ($ctTarifAutreSce->getCtTypeAutreSce() === $this) {
                $ctTarifAutreSce->setCtTypeAutreSce(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CtAutreSce>
     */
    public function getCtAutreSces(): Collection
    {
        return $this->ctAutreSces;
    }

    public function addCtAutreSce(CtAutreSce $ctAutreSce): self
    {
        if (!$this->ctAutreSces->contains($ctAutreSce)) {
            $this->ctAutreSces[] = $ctAutreSce;
            $ctAutreSce->setCtTypeAutreSce($this);
        }

        return $this;
    }

    public function removeCtAutreSce(CtAutreSce $ctAutreSce): self
    {
        if ($this->ctAutreSces->removeElement($ctAutreSce)) {
            // set the owning side to null (unless already changed)
            if ($ctAutreSce->getCtTypeAutreSce() === $this) {
                $ctAutreSce->setCtTypeAutreSce(null);
            }
        }

        return $this;
    }
}
