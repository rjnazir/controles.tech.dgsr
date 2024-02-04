<?php

namespace App\Entity;

use App\Repository\CtGenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtGenreRepository::class)
 * @ORM\Table(
 *  name = "ct_genre",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_genre_categorie_id", "gr_libelle", "gr_code"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctGenreCategorie", "grLibelle", "grCode"},
 *  errorPath = "grLibelle",
 *  message = "Le genre avec cette catégorie entré est déjà existant.")
 */
class CtGenre
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
    private $grLibelle;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $grCode;

    /**
     * @ORM\ManyToOne(targetEntity=CtGenreCategorie::class, inversedBy="ctGenres")
     */
    private $ctGenreCategorie;

    /**
     * @ORM\OneToMany(targetEntity=CtVehicule::class, mappedBy="ctGenre")
     */
    private $ctVehicules;

    public function __construct()
    {
        $this->ctVehicules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrLibelle(): ?string
    {
        return $this->grLibelle;
    }

    public function setGrLibelle(?string $grLibelle): self
    {
        $this->grLibelle = $grLibelle;

        return $this;
    }

    public function getGrCode(): ?string
    {
        return $this->grCode;
    }

    public function setGrCode(?string $grCode): self
    {
        $this->grCode = $grCode;

        return $this;
    }

    public function getCtGenreCategorie(): ?CtGenreCategorie
    {
        return $this->ctGenreCategorie;
    }

    public function setCtGenreCategorie(?CtGenreCategorie $ctGenreCategorie): self
    {
        $this->ctGenreCategorie = $ctGenreCategorie;

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
            $ctVehicule->setCtGenre($this);
        }

        return $this;
    }

    public function removeCtVehicule(CtVehicule $ctVehicule): self
    {
        if ($this->ctVehicules->removeElement($ctVehicule)) {
            // set the owning side to null (unless already changed)
            if ($ctVehicule->getCtGenre() === $this) {
                $ctVehicule->setCtGenre(null);
            }
        }

        return $this;
    }
}
