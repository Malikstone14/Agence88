<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`gh`')]
class GH
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string", length: 255)]
    private $nom;

    #[ORM\ManyToOne(targetEntity: GHU::class, inversedBy: "ghs")]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\JoinColumn(name: "ghu_id", referencedColumnName: "id")]


    private $ghu;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getGhu(): ?GHU
    {
        return $this->ghu;
    }

    public function setGhu(?GHU $ghu): self
    {
        $this->ghu = $ghu;

        return $this;
    }
}
