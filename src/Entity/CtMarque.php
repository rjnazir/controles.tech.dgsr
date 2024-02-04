<?php

namespace App\Entity;

use App\Repository\CtMarqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtMarqueRepository::class)
 * @UniqueEntity(
 *  fields={"mrqLibelle"},
 *  message="La marque entrée est déjà existante."
 * )
 */
class CtMarque
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
    private $mrqLibelle;

    /**
     * @ORM\OneToMany(targetEntity=CtVehicule::class, mappedBy="ctMarque")
     */
    private $ctVehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMrqLibelle(): ?string
    {
        return $this->mrqLibelle;
    }

    public function setMrqLibelle(?string $mrqLibelle): self
    {
        $this->mrqLibelle = $mrqLibelle;

        return $this;
    }
    /**
     * @return Collection<int, CtVehicule>
     */
    public function getCtVehicules(): Collection
    {
        return $this->ctVehicules;
    }

    public function addCtVehicule(CtVehicule $ctVehicule): self
    {
        if (!$this->ctVehicules->contains($ctVehicule)) {
            $this->ctVehicules[] = $ctVehicule;
            $ctVehicule->setCtMarque($this);
        }

        return $this;
    }

    public function removeCtVehicule(CtVehicule $ctVehicule): self
    {
        if ($this->ctVehicules->removeElement($ctVehicule)) {
            // set the owning side to null (unless already changed)
            if ($ctVehicule->getCtMarque() === $this) {
                $ctVehicule->setCtMarque(null);
            }
        }

        return $this;
    }
}
