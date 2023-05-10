<?php

namespace App\Entity;

use App\Repository\CtConstAvDedTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtConstAvDedTypeRepository::class)
 * @UniqueEntity(
 *  fields={"cadTpLibelle"},
 *  message="Le libellé entrés est déjà existant"
 * )
 */
class CtConstAvDedType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, unique=true)
     */
    private $cadTpLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCadTpLibelle(): ?string
    {
        return $this->cadTpLibelle;
    }

    public function setCadTpLibelle(?string $cadTpLibelle): self
    {
        $this->cadTpLibelle = $cadTpLibelle;

        return $this;
    }
}
