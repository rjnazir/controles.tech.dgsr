<?php

namespace App\Entity;

use App\Repository\CtTypeReceptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtTypeReceptionRepository::class)
 * @UniqueEntity(
 *  fields={"tprcpLibelle"},
 *  message="Le libellé entré est déjà existant."
 * )
 */
class CtTypeReception
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, unique=true)
     * 
     */
    private $tprcpLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtReception::class, mappedBy="ctTypeReception")
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

    public function getTprcpLibelle(): ?string
    {
        return $this->tprcpLibelle;
    }

    public function setTprcpLibelle(?string $tprcpLibelle): self
    {
        $this->tprcpLibelle = $tprcpLibelle;

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
            $ctReception->setCtTypeReception($this);
        }

        return $this;
    }

    public function removeCtReception(CtReception $ctReception): self
    {
        if ($this->ctReceptions->removeElement($ctReception)) {
            // set the owning side to null (unless already changed)
            if ($ctReception->getCtTypeReception() === $this) {
                $ctReception->setCtTypeReception(null);
            }
        }

        return $this;
    }
}
