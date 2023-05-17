<?php

namespace App\Entity;

use App\Repository\CtVisiteExtraRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtVisiteExtraRepository::class)
 * @UniqueEntity(
 *  fields={"vsteLibelle"},
 *  message="Le libellé entré est déjà existant."
 * )
 */
class CtVisiteExtra
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
    private $vsteLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVsteLibelle(): ?string
    {
        return $this->vsteLibelle;
    }

    public function setVsteLibelle(?string $vsteLibelle): self
    {
        $this->vsteLibelle = $vsteLibelle;

        return $this;
    }
}
