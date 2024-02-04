<?php

namespace App\Entity;

use App\Repository\CtSourceEnergieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtSourceEnergieRepository::class)
 * @UniqueEntity(
 *  fields={"sreLibelle"},
 *  message="La source d'énergie entrée est déjà existante."
 * )
 */
class CtSourceEnergie
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
    private $sreLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtReception::class, mappedBy="ctSourceEnergie")
     */
    private $ctReceptions;

    public function __construct()
    {
        $this->ctReceptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSreLibelle(): ?string
    {
        return $this->sreLibelle;
    }

    public function setSreLibelle(?string $sreLibelle): self
    {
        $this->sreLibelle = $sreLibelle;

        return $this;
    }

    /**
     * @return Collection<int, CtReception>
     */
    public function getCtReceptions(): Collection
    {
        return $this->ctReceptions;
    }

    public function addCtReception(CtReception $ctReception): self
    {
        if (!$this->ctReceptions->contains($ctReception)) {
            $this->ctReceptions[] = $ctReception;
            $ctReception->setCtSourceEnergie($this);
        }

        return $this;
    }

    public function removeCtReception(CtReception $ctReception): self
    {
        if ($this->ctReceptions->removeElement($ctReception)) {
            // set the owning side to null (unless already changed)
            if ($ctReception->getCtSourceEnergie() === $this) {
                $ctReception->setCtSourceEnergie(null);
            }
        }

        return $this;
    }
}
