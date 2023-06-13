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
 *              "ct_centre_id", "ct_imprime_tech_id", "edb_numero"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctCentre", "ctImprimeTech", "edbNumero"},
 *  errorPath = "ctImprimeTech",
 *  message = "Le type d'imprimé entrée est déjà existant dans l'expression de besoin."
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
     * @ORM\Column(type="integer")
     */
    private $edbQteDemander;

    /**
     * @ORM\ManyToOne(targetEntity=CtCentre::class, inversedBy="ctExpressionBesoins")
     */
    private $ctCentre;

    /**
     * @ORM\ManyToOne(targetEntity=CtImprimeTech::class, inversedBy="ctExpressionBesoins")
     */
    private $ctImprimeTech;

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
     * @ORM\OneToMany(targetEntity=CtBordereau::class, mappedBy="ctExpressionBesoin")
     */
    private $ctBordereaus;

    public function __construct()
    {
        $this->ctBordereaus = new ArrayCollection();
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

    public function getEdbQteDemander(): ?int
    {
        return $this->edbQteDemander;
    }

    public function setEdbQteDemander(int $edbQteDemander): self
    {
        $this->edbQteDemander = $edbQteDemander;

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

    public function getCtImprimeTech(): ?CtImprimeTech
    {
        return $this->ctImprimeTech;
    }

    public function setCtImprimeTech(?CtImprimeTech $ctImprimeTech): self
    {
        $this->ctImprimeTech = $ctImprimeTech;

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
     * @return Collection<int, CtBordereau>
     */
    public function getCtBordereaus(): Collection
    {
        return $this->ctBordereaus;
    }

    public function addCtBordereau(CtBordereau $ctBordereau): self
    {
        if (!$this->ctBordereaus->contains($ctBordereau)) {
            $this->ctBordereaus[] = $ctBordereau;
            $ctBordereau->setCtExpressionBesoin($this);
        }

        return $this;
    }

    public function removeCtBordereau(CtBordereau $ctBordereau): self
    {
        if ($this->ctBordereaus->removeElement($ctBordereau)) {
            // set the owning side to null (unless already changed)
            if ($ctBordereau->getCtExpressionBesoin() === $this) {
                $ctBordereau->setCtExpressionBesoin(null);
            }
        }

        return $this;
    }
}
