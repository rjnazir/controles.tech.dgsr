<?php

namespace App\Entity;

use App\Repository\CtTypeDroitPtacRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtTypeDroitPtacRepository::class)
 * @UniqueEntity(fields="tpDpLibelle", message="Le libellé entré est déjà existant")
 */
class CtTypeDroitPtac
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, unique=true)
     */
    private $tpDpLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtDroitPtac::class, mappedBy="ctTypeDroitPtac")
     */
    private $ctDroitPtacs;

    public function __construct()
    {
        $this->ctDroitPtacs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpDpLibelle(): ?string
    {
        return $this->tpDpLibelle;
    }

    public function setTpDpLibelle(?string $tpDpLibelle): self
    {
        $this->tpDpLibelle = $tpDpLibelle;

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
            $ctDroitPtac->setCtTypeDroitPtac($this);
        }

        return $this;
    }

    public function removeCtDroitPtac(CtDroitPtac $ctDroitPtac): self
    {
        if ($this->ctDroitPtacs->removeElement($ctDroitPtac)) {
            // set the owning side to null (unless already changed)
            if ($ctDroitPtac->getCtTypeDroitPtac() === $this) {
                $ctDroitPtac->setCtTypeDroitPtac(null);
            }
        }

        return $this;
    }
}
