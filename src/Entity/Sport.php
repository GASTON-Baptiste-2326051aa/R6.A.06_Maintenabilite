<?php

namespace App\Entity;

use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /** @var Collection<int, Type> */
    #[ORM\ManyToMany(targetEntity: Type::class, mappedBy: 'sports')]
    private Collection $types;

    /**
     * @var Collection<int, Trial>
     */
    #[ORM\ManyToMany(targetEntity: Trial::class, mappedBy: 'sport_id')]
    private Collection $trials;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->trials = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /** @return Collection<int, Type> */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
            // IMPORTANT : ne rappelle pas addSport ici sinon boucle
            // c'est Type (owning side) qui synchronise
        }
        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->types->removeElement($type);
        return $this;
    }

    /**
     * @return Collection<int, Trial>
     */
    public function getTrials(): Collection
    {
        return $this->trials;
    }

    public function addTrial(Trial $trial): static
    {
        if (!$this->trials->contains($trial)) {
            $this->trials->add($trial);
            $trial->addSportId($this);
        }

        return $this;
    }

    public function removeTrial(Trial $trial): static
    {
        if ($this->trials->removeElement($trial)) {
            $trial->removeSportId($this);
        }

        return $this;
    }
}
