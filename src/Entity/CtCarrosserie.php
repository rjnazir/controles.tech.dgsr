<?php

namespace App\Entity;

use App\Repository\CtCarrosserieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtCarrosserieRepository::class)
 * @UniqueEntity(fields="crsLibelle", message="Le libellé entré est déjà existant")
 */
class CtCarrosserie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $crsLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCrsLibelle(): ?string
    {
        return $this->crsLibelle;
    }

    public function setCrsLibelle(?string $crsLibelle): self
    {
        $this->crsLibelle = $crsLibelle;

        return $this;
    }
}
