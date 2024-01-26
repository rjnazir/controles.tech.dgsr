<?php

namespace App\Entity;

use App\Repository\CtCentreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CtCentreRepository::class)
 * @UniqueEntity(fields="ctr_nom", message="Le libellé entré est déjà existant")
 */
class CtCentre
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
    private $ctr_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctr_code;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $ctr_created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $ctr_updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=CtProvince::class, inversedBy="ctCentres")
     */
    private $ctProvince;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="ctCentre")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=CtExpressionBesoin::class, mappedBy="ctCentre")
     */
    private $ctExpressionBesoins;

    /**
     * @ORM\OneToMany(targetEntity=CtBordereau::class, mappedBy="ctCentre")
     */
    private $ctBordereaus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isParent;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\Length(
     *  max = 50,
     *  maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $ctrAcronyme;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->ctExpressionBesoins = new ArrayCollection();
        $this->ctBordereaus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtrNom(): ?string
    {
        return $this->ctr_nom;
    }

    public function setCtrNom(?string $ctr_nom): self
    {
        $this->ctr_nom = $ctr_nom;

        return $this;
    }

    public function getCtrCode(): ?string
    {
        return $this->ctr_code;
    }

    public function setCtrCode(?string $ctr_code): self
    {
        $this->ctr_code = $ctr_code;

        return $this;
    }

    public function getCtrCreatedAt(): ?\DateTimeImmutable
    {
        return $this->ctr_created_at;
    }

    public function setCtrCreatedAt(?\DateTimeImmutable $ctr_created_at): self
    {
        $this->ctr_created_at = $ctr_created_at;

        return $this;
    }

    public function getCtrUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->ctr_updated_at;
    }

    public function setCtrUpdatedAt(?\DateTimeImmutable $ctr_updated_at): self
    {
        $this->ctr_updated_at = $ctr_updated_at;

        return $this;
    }

    public function getCtProvince(): ?CtProvince
    {
        return $this->ctProvince;
    }

    public function setCtProvince(?CtProvince $ctProvince): self
    {
        $this->ctProvince = $ctProvince;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCtCentre($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCtCentre() === $this) {
                $user->setCtCentre(null);
            }
        }

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
            $ctExpressionBesoin->setCtCentre($this);
        }

        return $this;
    }

    public function removeCtExpressionBesoin(CtExpressionBesoin $ctExpressionBesoin): self
    {
        if ($this->ctExpressionBesoins->removeElement($ctExpressionBesoin)) {
            // set the owning side to null (unless already changed)
            if ($ctExpressionBesoin->getCtCentre() === $this) {
                $ctExpressionBesoin->setCtCentre(null);
            }
        }

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
            $ctBordereau->setCtCentre($this);
        }

        return $this;
    }

    public function removeCtBordereau(CtBordereau $ctBordereau): self
    {
        if ($this->ctBordereaus->removeElement($ctBordereau)) {
            // set the owning side to null (unless already changed)
            if ($ctBordereau->getCtCentre() === $this) {
                $ctBordereau->setCtCentre(null);
            }
        }

        return $this;
    }

    public function getIsParent(): ?bool
    {
        return $this->isParent;
    }

    public function setIsParent(bool $isParent): self
    {
        $this->isParent = $isParent;

        return $this;
    }

    public function getCtrAcronyme(): ?string
    {
        return $this->ctrAcronyme;
    }

    public function setCtrAcronyme(?string $ctrAcronyme): self
    {
        $this->ctrAcronyme = $ctrAcronyme;

        return $this;
    }
}
