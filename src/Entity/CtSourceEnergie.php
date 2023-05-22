<?php

namespace App\Entity;

use App\Repository\CtSourceEnergieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtSourceEnergieRepository::class)
 * @UniqueEntity(
 *  fields={"sreLibelle"},
 *  message="La source d'énergie entrée est déjà existante."
 * )
 */
class CtSourceEnergie
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
    private $sreLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSreLibelle(): ?string
    {
        return $this->sreLibelle;
    }

    public function setSreLibelle(?string $sreLibelle): self
    {
        $this->sreLibelle = $sreLibelle;

        return $this;
    }
}
