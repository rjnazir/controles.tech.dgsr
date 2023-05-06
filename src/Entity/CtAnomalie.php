<?php

namespace App\Entity;

use App\Repository\CtAnomalieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtAnomalieRepository::class)
 */
class CtAnomalie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $anml_libelle;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $anml_code;

    /**
     * @ORM\ManyToOne(targetEntity=CtAnomalieType::class, inversedBy="ctAnomalies")
     */
    private $ctAnomalieType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnmlLibelle(): ?string
    {
        return $this->anml_libelle;
    }

    public function setAnmlLibelle(?string $anml_libelle): self
    {
        $this->anml_libelle = $anml_libelle;

        return $this;
    }

    public function getAnmlCode(): ?string
    {
        return $this->anml_code;
    }

    public function setAnmlCode(?string $anml_code): self
    {
        $this->anml_code = $anml_code;

        return $this;
    }

    public function getCtAnomalieType(): ?CtAnomalieType
    {
        return $this->ctAnomalieType;
    }

    public function setCtAnomalieType(?CtAnomalieType $ctAnomalieType): self
    {
        $this->ctAnomalieType = $ctAnomalieType;

        return $this;
    }
}
