<?php

namespace App\Entity;

use App\Repository\CtAnomalieTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtAnomalieTypeRepository::class)
 * @UniqueEntity(fields="atp_libelle", message="Le libellé entré est déjà existant")
 */
class CtAnomalieType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, unique=true)
     */
    private $atp_libelle;

    /**
     * @ORM\OneToMany(targetEntity=CtAnomalie::class, mappedBy="ctAnomalieType")
     */
    private $ctAnomalies;

    public function __construct()
    {
        $this->ctAnomalies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAtpLibelle(): ?string
    {
        return $this->atp_libelle;
    }

    public function setAtpLibelle(string $atp_libelle): self
    {
        $this->atp_libelle = $atp_libelle;

        return $this;
    }

    /**
     * @return Collection<int, CtAnomalie>
     */
    public function getCtAnomalies(): Collection
    {
        return $this->ctAnomalies;
    }

    public function addCtAnomaly(CtAnomalie $ctAnomaly): self
    {
        if (!$this->ctAnomalies->contains($ctAnomaly)) {
            $this->ctAnomalies[] = $ctAnomaly;
            $ctAnomaly->setCtAnomalieType($this);
        }

        return $this;
    }

    public function removeCtAnomaly(CtAnomalie $ctAnomaly): self
    {
        if ($this->ctAnomalies->removeElement($ctAnomaly)) {
            // set the owning side to null (unless already changed)
            if ($ctAnomaly->getCtAnomalieType() === $this) {
                $ctAnomaly->setCtAnomalieType(null);
            }
        }

        return $this;
    }
}
