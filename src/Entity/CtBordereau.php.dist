<?php

namespace App\Entity;

use App\Repository\CtBordereauRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtBordereauRepository::class)
 * @ORM\Table(
 *  name = "ct_bordereau",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_centre_id", "ct_imprime_tech_id", "be_numero", "be_debut_numero", "be_fin_numero"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctCentre", "ctImprimeTech", "beNumero", "beDebutNumero", "beFinNumero"},
 *  errorPath = "ctImprimeTech",
 *  message = "Le type d'imprimé entrée est déjà existant dans le bordereau d'envoi."
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
     * @ORM\ManyToOne(targetEntity=CtImprimeTech::class, inversedBy="ctBordereaus")
     */
    private $ctImprimeTech;

    /**
     * @ORM\ManyToOne(targetEntity=CtExpressionBesoin::class, inversedBy="ctBordereaus")
     */
    private $ctExpressionBesoin;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctBordereaus")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=124)
     */
    private $beNumero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $beDebutNumero;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $beFinNumero;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $beCreatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $beUpdatedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $beDateEdit;

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

    public function getCtImprimeTech(): ?CtImprimeTech
    {
        return $this->ctImprimeTech;
    }

    public function setCtImprimeTech(?CtImprimeTech $ctImprimeTech): self
    {
        $this->ctImprimeTech = $ctImprimeTech;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBeDebutNumero(): ?int
    {
        return $this->beDebutNumero;
    }

    public function setBeDebutNumero(?int $beDebutNumero): self
    {
        $this->beDebutNumero = $beDebutNumero;

        return $this;
    }

    public function getBeFinNumero(): ?int
    {
        return $this->beFinNumero;
    }

    public function setBeFinNumero(?int $beFinNumero): self
    {
        $this->beFinNumero = $beFinNumero;

        return $this;
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

    public function getBeDateEdit(): ?\DateTimeInterface
    {
        return $this->beDateEdit;
    }

    public function setBeDateEdit(?\DateTimeInterface $beDateEdit): self
    {
        $this->beDateEdit = $beDateEdit;

        return $this;
    }
}
