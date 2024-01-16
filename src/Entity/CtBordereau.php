<?php

namespace App\Entity;

use App\Repository\CtBordereauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtBordereauRepository::class)
 * @ORM\Table(
 *  name = "ct_bordereau",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_centre_id", "be_numero"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctCentre", "beNumero"},
 *  errorPath = "beNumero",
 *  message = "Le numéro de BE entrée est déjà existant."
 * )
 */
class CtBordereau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtCentre::class, inversedBy="ctBordereaus")
     */
    private $ctCentre;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctBordereaus")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=124)
     */
    private $beNumero;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $beDateEdit;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $beCreatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $beUpdatedAt;

    /**
     * @ORM\OneToOne(targetEntity=CtExpressionBesoin::class, cascade={"persist", "detach"})
     */
    private $ctExpressionBesoin;

    /**
     * @ORM\OneToMany(targetEntity=CtContenu::class, mappedBy="ctExpressionBesoin")
     */
    private $ctContenus;

    public function __construct()
    {
        $this->ctContenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtCentre(): ?CtCentre
    {
        return $this->ctCentre;
    }

    public function setCtCentre(?CtCentre $ctCentre): self
    {
        $this->ctCentre = $ctCentre;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getBeNumero(): ?string
    {
        return $this->beNumero;
    }

    public function setBeNumero(string $beNumero): self
    {
        $this->beNumero = $beNumero;

        return $this;
    }

    public function getBeDateEdit(): ?\DateTimeInterface
    {
        return $this->beDateEdit;
    }

    public function setBeDateEdit(?\DateTimeInterface $beDateEdit): self
    {
        $this->beDateEdit = $beDateEdit;

        return $this;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBeCreatedAt(): ?\DateTimeImmutable
    {
        return $this->beCreatedAt;
    }

    public function setBeCreatedAt(?\DateTimeImmutable $beCreatedAt): self
    {
        $this->beCreatedAt = $beCreatedAt;

        return $this;
    }

    public function getBeUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->beUpdatedAt;
    }

    public function setBeUpdatedAt(?\DateTimeImmutable $beUpdatedAt): self
    {
        $this->beUpdatedAt = $beUpdatedAt;

        return $this;
    }

    public function getCtExpressionBesoin(): ?CtExpressionBesoin
    {
        return $this->ctExpressionBesoin;
    }

    public function setCtExpressionBesoin(?CtExpressionBesoin $ctExpressionBesoin): self
    {
        $this->ctExpressionBesoin = $ctExpressionBesoin;

        return $this;
    }


    /**
     * @return Collection<int, CtContenu>
     */
    public function getCtContenus(): Collection
    {
        return $this->ctContenus;
    }

    public function addCtContenu(CtContenu $ctContenu): self
    {
        if (!$this->ctContenus->contains($ctContenu)) {
            $this->ctContenus[] = $ctContenu;
            $ctContenu->setCtbordereau($this);
        }

        return $this;
    }

    public function removeCtContenu(CtContenu $ctContenu): self
    {
        if ($this->ctContenus->removeElement($ctContenu)) {
            // set the owning side to null (unless already changed)
            if ($ctContenu->getCtbordereau() === $this) {
                $ctContenu->setCtbordereau(null);
            }
        }

        return $this;
    }
}
