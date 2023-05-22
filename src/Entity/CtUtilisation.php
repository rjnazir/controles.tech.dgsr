<?php

namespace App\Entity;

use App\Repository\CtUtilisationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtUtilisationRepository::class)
 * @UniqueEntity(
 *  fields={"utLibelle"},
 *  message="L'utilisation entrée est déjà existante."
 * )
 */
class CtUtilisation
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
    private $utLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtLibelle(): ?string
    {
        return $this->utLibelle;
    }

    public function setUtLibelle(?string $utLibelle): self
    {
        $this->utLibelle = $utLibelle;

        return $this;
    }
}
