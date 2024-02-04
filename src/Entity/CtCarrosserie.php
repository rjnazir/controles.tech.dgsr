<?php

namespace App\Entity;

use App\Repository\CtCarrosserieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtCarrosserieRepository::class)
 * @UniqueEntity(fields="crsLibelle", message="Le libellé entré est déjà existant")
 */
class CtCarrosserie
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
    private $crsLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtReception::class, mappedBy="ctCarrosserie")
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

    public function getCrsLibelle(): ?string
    {
        return $this->crsLibelle;
    }

    public function setCrsLibelle(?string $crsLibelle): self
    {
        $this->crsLibelle = $crsLibelle;

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
            $ctReception->setCtCarrosserie($this);
        }

        return $this;
    }

    public function removeCtReception(CtReception $ctReception): self
    {
        if ($this->ctReceptions->removeElement($ctReception)) {
            // set the owning side to null (unless already changed)
            if ($ctReception->getCtCarrosserie() === $this) {
                $ctReception->setCtCarrosserie(null);
            }
        }

        return $this;
    }
}
