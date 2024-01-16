<?php

namespace App\Entity;

use App\Repository\CtContenuRepository;
use App\Repository\CtExpressionBesoinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtContenuRepository::class)
 * @ORM\Table(
 *  name = "ct_contenu",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {
 *              "ct_expression_besoin_id", "ct_imprime_tech_id"
 *          }
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"ctExpressionBesoin", "ctImprimeTech"},
 *  errorPath = "ctImprimeTech",
 *  message = "L'imprimé entrée est déjà existant dans l'expression de besoin."
 * )
 */
class CtContenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtImprimeTech::class, inversedBy="ctContenus")
     */
    private $ctImprimeTech;

    /**
     * @ORM\Column(type="float")
     */
    private $qteDemande;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $debutNumero;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $finNumero;

    /**
     * @ORM\ManyToOne(targetEntity=CtExpressionBesoin::class, inversedBy="ctContenus")
     */
    private $ctExpressionBesoin;

    /**
     * @ORM\ManyToOne(targetEntity=CtBordereau::class, inversedBy="ctContenus")
     */
    private $ctBordereau;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQteDemande(): ?float
    {
        return $this->qteDemande;
    }

    public function setQteDemande(float $qteDemande): self
    {
        $this->qteDemande = $qteDemande;

        return $this;
    }

    public function getDebutNumero(): ?float
    {
        return $this->debutNumero;
    }

    public function setDebutNumero(?float $debutNumero): self
    {
        $this->debutNumero = $debutNumero;

        return $this;
    }

    public function getFinNumero(): ?float
    {
        return $this->finNumero;
    }

    public function setFinNumero(?float $finNumero): self
    {
        $this->finNumero = $finNumero;

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

    public function getCtBordereau(): ?CtBordereau
    {
        return $this->ctBordereau;
    }

    public function setCtBordereau(?CtBordereau $ctBordereau): self
    {
        $this->ctBordereau = $ctBordereau;

        return $this;
    }

}
