<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $opponent;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="plannings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getOpponent(): ?string
    {
        return $this->opponent;
    }

    public function setOpponent(string $opponent): self
    {
        $this->opponent = $opponent;

        return $this;
    }

    public function getTeam(): ?Equipe
    {
        return $this->team;
    }

    public function setTeam(?Equipe $team): self
    {
        $this->team = $team;

        return $this;
    }
}
