<?php

namespace App\Entity;

use App\Repository\CtVisiteExtraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtVisiteExtraRepository::class)
 * @UniqueEntity(
 *  fields={"vsteLibelle"},
 *  message="Le libellé entré est déjà existant."
 * )
 */
class CtVisiteExtra
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $vsteLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtVisiteExtraTarif::class, mappedBy="ctVisiteExtra")
     */
    private $ctVisiteExtraTarifs;

    public function __construct()
    {
        $this->ctVisiteExtraTarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVsteLibelle(): ?string
    {
        return $this->vsteLibelle;
    }

    public function setVsteLibelle(?string $vsteLibelle): self
    {
        $this->vsteLibelle = $vsteLibelle;

        return $this;
    }

    /**
     * @return Collection<int, CtVisiteExtraTarif>
     */
    public function getCtVisiteExtraTarifs(): Collection
    {
        return $this->ctVisiteExtraTarifs;
    }

    public function addCtVisiteExtraTarif(CtVisiteExtraTarif $ctVisiteExtraTarif): self
    {
        if (!$this->ctVisiteExtraTarifs->contains($ctVisiteExtraTarif)) {
            $this->ctVisiteExtraTarifs[] = $ctVisiteExtraTarif;
            $ctVisiteExtraTarif->setCtVisiteExtra($this);
        }

        return $this;
    }

    public function removeCtVisiteExtraTarif(CtVisiteExtraTarif $ctVisiteExtraTarif): self
    {
        if ($this->ctVisiteExtraTarifs->removeElement($ctVisiteExtraTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctVisiteExtraTarif->getCtVisiteExtra() === $this) {
                $ctVisiteExtraTarif->setCtVisiteExtra(null);
            }
        }

        return $this;
    }
}
