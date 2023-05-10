<?php

namespace App\Entity;

use App\Repository\CtTypeReceptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtTypeReceptionRepository::class)
 * @UniqueEntity(
 *  fields={"tprcpLibelle"},
 *  message="Le libellé entrés est déjà existant"
 * )
 */
class CtTypeReception
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, unique=true)
     * 
     */
    private $tprcpLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTprcpLibelle(): ?string
    {
        return $this->tprcpLibelle;
    }

    public function setTprcpLibelle(?string $tprcpLibelle): self
    {
        $this->tprcpLibelle = $tprcpLibelle;

        return $this;
    }
}
