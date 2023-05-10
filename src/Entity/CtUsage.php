<?php

namespace App\Entity;

use App\Repository\CtUsageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtUsageRepository::class)
 * @UniqueEntity(
 *  fields={"usgLibelle", "usgValidite"},
 *  message="Le libellé avec cette validité entrés est déjà existant"
 * )
 */
class CtUsage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $usgLibelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $usgValidite;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $usgCreated;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $usgUpdated;

    /**
     * @ORM\OneToMany(targetEntity=CtUsageTarif::class, mappedBy="ctUsage")
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

    public function getUsgLibelle(): ?string
    {
        return $this->usgLibelle;
    }

    public function setUsgLibelle(?string $usgLibelle): self
    {
        $this->usgLibelle = $usgLibelle;

        return $this;
    }

    public function getUsgValidite(): ?string
    {
        return $this->usgValidite;
    }

    public function setUsgValidite(?string $usgValidite): self
    {
        $this->usgValidite = $usgValidite;

        return $this;
    }

    public function getUsgCreated(): ?\DateTimeImmutable
    {
        return $this->usgCreated;
    }

    public function setUsgCreated(?\DateTimeImmutable $usgCreated): self
    {
        $this->usgCreated = $usgCreated;

        return $this;
    }

    public function getUsgUpdated(): ?\DateTimeImmutable
    {
        return $this->usgUpdated;
    }

    public function setUsgUpdated(?\DateTimeImmutable $usgUpdated): self
    {
        $this->usgUpdated = $usgUpdated;

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
            $ctUsageTarif->setCtUsage($this);
        }

        return $this;
    }

    public function removeCtUsageTarif(CtUsageTarif $ctUsageTarif): self
    {
        if ($this->ctUsageTarifs->removeElement($ctUsageTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctUsageTarif->getCtUsage() === $this) {
                $ctUsageTarif->setCtUsage(null);
            }
        }

        return $this;
    }
}
