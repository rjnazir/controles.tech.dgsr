<?php

namespace App\Entity;

use App\Repository\CtUtilisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtUtilisationRepository::class)
 * @UniqueEntity(
 *  fields={"utLibelle"},
 *  message="L'utilisation entrée est déjà existante."
 * )
 */
class CtUtilisation
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
    private $utLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtReception::class, mappedBy="ctUtilisation")
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

    public function getUtLibelle(): ?string
    {
        return $this->utLibelle;
    }

    public function setUtLibelle(?string $utLibelle): self
    {
        $this->utLibelle = $utLibelle;

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
            $ctReception->setCtUtilisation($this);
        }

        return $this;
    }

    public function removeCtReception(CtReception $ctReception): self
    {
        if ($this->ctReceptions->removeElement($ctReception)) {
            // set the owning side to null (unless already changed)
            if ($ctReception->getCtUtilisation() === $this) {
                $ctReception->setCtUtilisation(null);
            }
        }

        return $this;
    }
}
