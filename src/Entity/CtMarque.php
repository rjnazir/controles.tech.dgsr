<?php

namespace App\Entity;

use App\Repository\CtMarqueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtMarqueRepository::class)
 * @UniqueEntity(
 *  fields={"mrqLibelle"},
 *  message="La marque entrée est déjà existante."
 * )
 */
class CtMarque
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
    private $mrqLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMrqLibelle(): ?string
    {
        return $this->mrqLibelle;
    }

    public function setMrqLibelle(?string $mrqLibelle): self
    {
        $this->mrqLibelle = $mrqLibelle;

        return $this;
    }
}
