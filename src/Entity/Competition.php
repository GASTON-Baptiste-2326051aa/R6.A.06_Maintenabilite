<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    private ?championship $championship_id = null;

    /**
     * @var Collection<int, Trial>
     */
    #[ORM\ManyToMany(targetEntity: Trial::class, mappedBy: 'competition_id')]
    private Collection $trials;

    public function __construct()
    {
        $this->trials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getChampionshipId(): ?championship
    {
        return $this->championship_id;
    }

    public function setChampionshipId(?championship $championship_id): static
    {
        $this->championship_id = $championship_id;

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
            $trial->addCompetitionId($this);
        }

        return $this;
    }

    public function removeTrial(Trial $trial): static
    {
        if ($this->trials->removeElement($trial)) {
            $trial->removeCompetitionId($this);
        }

        return $this;
    }
}
