<?php

namespace App\Entity;

use App\Repository\CtAutreSceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtAutreSceRepository::class)
 */
class CtAutreSce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtTypeAutreSce::class, inversedBy="ctAutreSces")
     */
    private $ctTypeAutreSce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCtTypeAutreSce(): ?CtTypeAutreSce
    {
        return $this->ctTypeAutreSce;
    }

    public function setCtTypeAutreSce(?CtTypeAutreSce $ctTypeAutreSce): self
    {
        $this->ctTypeAutreSce = $ctTypeAutreSce;

        return $this;
    }
}
