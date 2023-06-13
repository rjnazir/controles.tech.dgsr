<?php

namespace App\Entity;

use App\Repository\CtExpressionBesoinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtExpressionBesoinRepository::class)
 * @ORM\Table(
 *  name = "ct_expression_besoin",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_centre_id", "edb_numero"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctCentre", "edbNumero"},
 *  errorPath = "edbNumero",
 *  message = "Le numéro de l'EDB entrée est déjà existant dans l'expression de besoin."
 * )
 */
class CtExpressionBesoin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $edbNumero;

    /**
     * @ORM\Column(type="date")
     */
    private $edbDateEdit;

    /**
     * @ORM\ManyToOne(targetEntity=CtCentre::class, inversedBy="ctExpressionBesoins")
     */
    private $ctCentre;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctExpressionBesoins")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $edbCreatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $edbUpdatedAt;

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

    public function getEdbNumero(): ?string
    {
        return $this->edbNumero;
    }

    public function setEdbNumero(string $edbNumero): self
    {
        $this->edbNumero = $edbNumero;

        return $this;
    }

    public function getEdbDateEdit(): ?\DateTimeInterface
    {
        return $this->edbDateEdit;
    }

    public function setEdbDateEdit(\DateTimeInterface $edbDateEdit): self
    {
        $this->edbDateEdit = $edbDateEdit;

        return $this;
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

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEdbCreatedAt(): ?\DateTimeImmutable
    {
        return $this->edbCreatedAt;
    }

    public function setEdbCreatedAt(?\DateTimeImmutable $edbCreatedAt): self
    {
        $this->edbCreatedAt = $edbCreatedAt;

        return $this;
    }

    public function getEdbUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->edbUpdatedAt;
    }

    public function setEdbUpdatedAt(?\DateTimeImmutable $edbUpdatedAt): self
    {
        $this->edbUpdatedAt = $edbUpdatedAt;

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
            $ctContenu->setCtExpressionBesoin($this);
        }

        return $this;
    }

    public function removeCtContenu(CtContenu $ctContenu): self
    {
        if ($this->ctContenus->removeElement($ctContenu)) {
            // set the owning side to null (unless already changed)
            if ($ctContenu->getCtExpressionBesoin() === $this) {
                $ctContenu->setCtExpressionBesoin(null);
            }
        }

        return $this;
    }
}
