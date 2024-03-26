<?php

namespace App\Entity;

use App\Repository\CtArretePrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtArretePrixRepository::class)
 * @UniqueEntity(fields="art_numero", message="Le numéro de l'arrêté entré est déjà existant")
 */
class CtArretePrix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=124, unique=true)
     */
    private $art_numero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $art_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $art_date_applic;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $art_created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $art_updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctArretePrixes")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CtMotifTarif::class, mappedBy="ctArretePrix")
     */
    private $ctMotifTarifs;

    /**
     * @ORM\OneToMany(targetEntity=CtUsageTarif::class, mappedBy="ctArretePrix")
     */
    private $ctUsageTarifs;

    /**
     * @ORM\OneToMany(targetEntity=CtDroitPtac::class, mappedBy="ctArretePrix")
     */
    private $ctDroitPtacs;

    /**
     * @ORM\OneToMany(targetEntity=CtProcesVerbal::class, mappedBy="ctArretePrix")
     */
    private $ctProcesVerbals;

    /**
     * @ORM\OneToMany(targetEntity=CtVisiteExtraTarif::class, mappedBy="ctArretePrix")
     */
    private $ctVisiteExtraTarifs;

    /**
     * @ORM\OneToMany(targetEntity=CtTarifAutreSce::class, mappedBy="ctArretePrix")
     */
    private $ctTarifAutreSces;

    public function __construct()
    {
        $this->ctMotifTarifs = new ArrayCollection();
        $this->ctUsageTarifs = new ArrayCollection();
        $this->ctDroitPtacs = new ArrayCollection();
        $this->ctProcesVerbals = new ArrayCollection();
        $this->ctVisiteExtraTarifs = new ArrayCollection();
        $this->ctTarifAutreSces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtNumero(): ?string
    {
        return $this->art_numero;
    }

    public function setArtNumero(string $art_numero): self
    {
        $this->art_numero = $art_numero;

        return $this;
    }

    public function getArtDate(): ?\DateTimeInterface
    {
        return $this->art_date;
    }

    public function setArtDate(?\DateTimeInterface $art_date): self
    {
        $this->art_date = $art_date;

        return $this;
    }

    public function getArtDateApplic(): ?\DateTimeInterface
    {
        return $this->art_date_applic;
    }

    public function setArtDateApplic(?\DateTimeInterface $art_date_applic): self
    {
        $this->art_date_applic = $art_date_applic;

        return $this;
    }

    public function getArtCreatedAt(): ?\DateTimeImmutable
    {
        return $this->art_created_at;
    }

    public function setArtCreatedAt(?\DateTimeImmutable $art_created_at): self
    {
        $this->art_created_at = $art_created_at;

        return $this;
    }

    public function getArtUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->art_updated_at;
    }

    public function setArtUpdatedAt(?\DateTimeImmutable $art_updated_at): self
    {
        $this->art_updated_at = $art_updated_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CtMotifTarif>
     */
    public function getCtMotifTarifs(): Collection
    {
        return $this->ctMotifTarifs;
    }

    public function addCtMotifTarif(CtMotifTarif $ctMotifTarif): self
    {
        if (!$this->ctMotifTarifs->contains($ctMotifTarif)) {
            $this->ctMotifTarifs[] = $ctMotifTarif;
            $ctMotifTarif->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtMotifTarif(CtMotifTarif $ctMotifTarif): self
    {
        if ($this->ctMotifTarifs->removeElement($ctMotifTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctMotifTarif->getCtArretePrix() === $this) {
                $ctMotifTarif->setCtArretePrix(null);
            }
        }

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
            $ctUsageTarif->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtUsageTarif(CtUsageTarif $ctUsageTarif): self
    {
        if ($this->ctUsageTarifs->removeElement($ctUsageTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctUsageTarif->getCtArretePrix() === $this) {
                $ctUsageTarif->setCtArretePrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CtDroitPtac>
     */
    public function getCtDroitPtacs(): Collection
    {
        return $this->ctDroitPtacs;
    }

    public function addCtDroitPtac(CtDroitPtac $ctDroitPtac): self
    {
        if (!$this->ctDroitPtacs->contains($ctDroitPtac)) {
            $this->ctDroitPtacs[] = $ctDroitPtac;
            $ctDroitPtac->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtDroitPtac(CtDroitPtac $ctDroitPtac): self
    {
        if ($this->ctDroitPtacs->removeElement($ctDroitPtac)) {
            // set the owning side to null (unless already changed)
            if ($ctDroitPtac->getCtArretePrix() === $this) {
                $ctDroitPtac->setCtArretePrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CtProcesVerbal>
     */
    public function getCtProcesVerbals(): Collection
    {
        return $this->ctProcesVerbals;
    }

    public function addCtProcesVerbal(CtProcesVerbal $ctProcesVerbal): self
    {
        if (!$this->ctProcesVerbals->contains($ctProcesVerbal)) {
            $this->ctProcesVerbals[] = $ctProcesVerbal;
            $ctProcesVerbal->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtProcesVerbal(CtProcesVerbal $ctProcesVerbal): self
    {
        if ($this->ctProcesVerbals->removeElement($ctProcesVerbal)) {
            // set the owning side to null (unless already changed)
            if ($ctProcesVerbal->getCtArretePrix() === $this) {
                $ctProcesVerbal->setCtArretePrix(null);
            }
        }

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
            $ctVisiteExtraTarif->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtVisiteExtraTarif(CtVisiteExtraTarif $ctVisiteExtraTarif): self
    {
        if ($this->ctVisiteExtraTarifs->removeElement($ctVisiteExtraTarif)) {
            // set the owning side to null (unless already changed)
            if ($ctVisiteExtraTarif->getCtArretePrix() === $this) {
                $ctVisiteExtraTarif->setCtArretePrix(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CtTarifAutreSce>
     */
    public function getCtTarifAutreSces(): Collection
    {
        return $this->ctTarifAutreSces;
    }

    public function addCtTarifAutreSce(CtTarifAutreSce $ctTarifAutreSce): self
    {
        if (!$this->ctTarifAutreSces->contains($ctTarifAutreSce)) {
            $this->ctTarifAutreSces[] = $ctTarifAutreSce;
            $ctTarifAutreSce->setCtArretePrix($this);
        }

        return $this;
    }

    public function removeCtTarifAutreSce(CtTarifAutreSce $ctTarifAutreSce): self
    {
        if ($this->ctTarifAutreSces->removeElement($ctTarifAutreSce)) {
            // set the owning side to null (unless already changed)
            if ($ctTarifAutreSce->getCtArretePrix() === $this) {
                $ctTarifAutreSce->setCtArretePrix(null);
            }
        }

        return $this;
    }
}
