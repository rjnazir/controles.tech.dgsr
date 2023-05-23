<?php

namespace App\Entity;

use App\Repository\CtImprimeTechRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtImprimeTechRepository::class)
 * @ORM\Table(
 *  name = "ct_imprime_tech",
 *  uniqueConstraints = {
 *      @ORM\UniqueConstraint(
 *          columns = {"nom_imprime_tech", "unite_imprime_tech", "abrev_imprime_tech"}
 *      )
 *  }
 * )
 * @UniqueEntity(
 *  fields = {"nomImprimeTech", "uniteImprimeTech", "abrevImprimeTech"},
 *  errorPath="nomImprimeTech",
 *  message="Le type d'imprimé technique entré est déjà existant.")
 */
class CtImprimeTech
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $nomImprimeTech;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $uniteImprimeTech;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $abrevImprimeTech;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $prttCreatedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $prttUpdatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ctImprimeTeches")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=CtExpressionBesoin::class, mappedBy="ctImprimeTech")
     */
    private $ctExpressionBesoins;

    public function __construct()
    {
        $this->ctExpressionBesoins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomImprimeTech(): ?string
    {
        return $this->nomImprimeTech;
    }

    public function setNomImprimeTech(string $nomImprimeTech): self
    {
        $this->nomImprimeTech = $nomImprimeTech;

        return $this;
    }

    public function getUniteImprimeTech(): ?string
    {
        return $this->uniteImprimeTech;
    }

    public function setUniteImprimeTech(string $uniteImprimeTech): self
    {
        $this->uniteImprimeTech = $uniteImprimeTech;

        return $this;
    }

    public function getAbrevImprimeTech(): ?string
    {
        return $this->abrevImprimeTech;
    }

    public function setAbrevImprimeTech(?string $abrevImprimeTech): self
    {
        $this->abrevImprimeTech = $abrevImprimeTech;

        return $this;
    }

    public function getPrttCreatedAt(): ?\DateTimeImmutable
    {
        return $this->prttCreatedAt;
    }

    public function setPrttCreatedAt(?\DateTimeImmutable $prttCreatedAt): self
    {
        $this->prttCreatedAt = $prttCreatedAt;

        return $this;
    }

    public function getPrttUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->prttUpdatedAt;
    }

    public function setPrttUpdatedAt(?\DateTimeImmutable $prttUpdatedAt): self
    {
        $this->prttUpdatedAt = $prttUpdatedAt;

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
     * @return Collection<int, CtExpressionBesoin>
     */
    public function getCtExpressionBesoins(): Collection
    {
        return $this->ctExpressionBesoins;
    }

    public function addCtExpressionBesoin(CtExpressionBesoin $ctExpressionBesoin): self
    {
        if (!$this->ctExpressionBesoins->contains($ctExpressionBesoin)) {
            $this->ctExpressionBesoins[] = $ctExpressionBesoin;
            $ctExpressionBesoin->setCtImprimeTech($this);
        }

        return $this;
    }

    public function removeCtExpressionBesoin(CtExpressionBesoin $ctExpressionBesoin): self
    {
        if ($this->ctExpressionBesoins->removeElement($ctExpressionBesoin)) {
            // set the owning side to null (unless already changed)
            if ($ctExpressionBesoin->getCtImprimeTech() === $this) {
                $ctExpressionBesoin->setCtImprimeTech(null);
            }
        }

        return $this;
    }
}
