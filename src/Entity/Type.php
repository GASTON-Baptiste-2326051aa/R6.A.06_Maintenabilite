<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /** @var Collection<int, Sport> */
    #[ORM\ManyToMany(targetEntity: Sport::class, inversedBy: 'types')]
    private Collection $sports;

    public function __construct()
    {
        $this->sports = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /** @return Collection<int, Sport> */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): static
    {
        if (!$this->sports->contains($sport)) {
            $this->sports->add($sport);
            $sport->addType($this); // synchro bidirectionnelle
        }
        return $this;
    }

    public function removeSport(Sport $sport): static
    {
        if ($this->sports->removeElement($sport)) {
            $sport->removeType($this);
        }
        return $this;
    }
}
