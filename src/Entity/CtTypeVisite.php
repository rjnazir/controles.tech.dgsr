<?php

namespace App\Entity;

use App\Repository\CtTypeVisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtTypeVisiteRepository::class)
 * @UniqueEntity(
 *  fields={"tpvLibelle"},
 *  message="Le libellé entré est déjà existant."
 * )
 */
class CtTypeVisite
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
    private $tpvLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtUsageTarif::class, mappedBy="ctTypeVisite")
     */
    private $ctUsageTarifs;

    public function __construct()
    {
        $this->ctUsageTarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpvLibelle(): ?string
    {
        return $this->tpvLibelle;
    }

    public function setTpvLibelle(?string $tpvLibelle): self
    {
        $this->tpvLibelle = $tpvLibelle;

        return $this;
    }

    /**
     * @return Collection<int, CtUsageTarif>
     */
    public function getCtUsageTarifs(): Collection
    {
        return $this->ctUsageTarifs;
    }

    public function addCtUsageTarif(CtUsageTarif $ctUsageTarif): self
    {
        if (!$this->ctUsageTarifs->contains($ctUsageTarif)) {
            $this->ctUsageTarifs[] = $ctUsageTarif;
            $ctUsageTarif->setCtTypeVisite($this);
        }

        return $this;
    }

    public function removeCtUsageTarif(CtUsageTarif $ctUsageTarif): self
    {
        if ($this->ctUsageTarifs->removeElement($ctUsageTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctUsageTarif->getCtTypeVisite() === $this) {
                $ctUsageTarif->setCtTypeVisite(null);
            }
        }

        return $this;
    }
}
