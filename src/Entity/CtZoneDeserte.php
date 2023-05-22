<?php

namespace App\Entity;

use App\Repository\CtZoneDeserteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtZoneDeserteRepository::class)
 * @UniqueEntity(
 *  fields={"zdLibelle"},
 *  message="La zone de servitude entrée est déjà existante."
 * )
 */
class CtZoneDeserte
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
    private $zdLibelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getZdLibelle(): ?string
    {
        return $this->zdLibelle;
    }

    public function setZdLibelle(string $zdLibelle): self
    {
        $this->zdLibelle = $zdLibelle;

        return $this;
    }
}
