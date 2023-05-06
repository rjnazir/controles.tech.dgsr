<?php

namespace App\Entity;

use App\Repository\CtTypeUsageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CtTypeUsageRepository::class)
 * @UniqueEntity(fields="tpu_libelle", message="Le libellé entré est déjà existant")
 */
class CtTypeUsage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $tpu_libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTpuLibelle(): ?string
    {
        return $this->tpu_libelle;
    }

    public function setTpuLibelle(string $tpu_libelle): self
    {
        $this->tpu_libelle = $tpu_libelle;

        return $this;
    }
}
