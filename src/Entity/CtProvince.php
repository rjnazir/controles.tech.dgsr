<?php

namespace App\Entity;

use App\Repository\CtProvinceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtProvinceRepository::class)
 * @UniqueEntity(fields="prv_nom", message="Le libellé entré est déjà existant")
 */
class CtProvince
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
    private $prv_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prv_code;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $prv_created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $prv_updated_at;

    /**
     * @ORM\OneToMany(targetEntity=CtCentre::class, mappedBy="ctProvince")
     */
    private $ctCentres;

    public function __construct()
    {
        $this->ctCentres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrvNom(): ?string
    {
        return $this->prv_nom;
    }

    public function setPrvNom(?string $prv_nom): self
    {
        $this->prv_nom = $prv_nom;

        return $this;
    }

    public function getPrvCode(): ?string
    {
        return $this->prv_code;
    }

    public function setPrvCode(string $prv_code): self
    {
        $this->prv_code = $prv_code;

        return $this;
    }

    public function getPrvCreatedAt(): ?\DateTimeImmutable
    {
        return $this->prv_created_at;
    }

    public function setPrvCreatedAt(?\DateTimeImmutable $prv_created_at): self
    {
        $this->prv_created_at = $prv_created_at;

        return $this;
    }

    public function getPrvUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->prv_updated_at;
    }

    public function setPrvUpdatedAt(?\DateTimeImmutable $prv_updated_at): self
    {
        $this->prv_updated_at = $prv_updated_at;

        return $this;
    }

    /**
     * @return Collection<int, CtCentre>
     */
    public function getCtCentres(): Collection
    {
        return $this->ctCentres;
    }

    public function addCtCentre(CtCentre $ctCentre): self
    {
        if (!$this->ctCentres->contains($ctCentre)) {
            $this->ctCentres[] = $ctCentre;
            $ctCentre->setCtProvince($this);
        }

        return $this;
    }

    public function removeCtCentre(CtCentre $ctCentre): self
    {
        if ($this->ctCentres->removeElement($ctCentre)) {
            // set the owning side to null (unless already changed)
            if ($ctCentre->getCtProvince() === $this) {
                $ctCentre->setCtProvince(null);
            }
        }

        return $this;
    }
}
