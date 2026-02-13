<?php

namespace App\Entity;

use App\Repository\TrialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrialRepository::class)]
class Trial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    /**
     * @var Collection<int, competition>
     */
    #[ORM\ManyToMany(targetEntity: competition::class, inversedBy: 'trials')]
    private Collection $competition_id;

    /**
     * @var Collection<int, sport>
     */
    #[ORM\ManyToMany(targetEntity: sport::class, inversedBy: 'trials')]
    private Collection $sport_id;

    public function __construct()
    {
        $this->competition_id = new ArrayCollection();
        $this->sport_id = new ArrayCollection();
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

    /**
     * @return Collection<int, competition>
     */
    public function getCompetitionId(): Collection
    {
        return $this->competition_id;
    }

    public function addCompetitionId(competition $competitionId): static
    {
        if (!$this->competition_id->contains($competitionId)) {
            $this->competition_id->add($competitionId);
        }

        return $this;
    }

    public function removeCompetitionId(competition $competitionId): static
    {
        $this->competition_id->removeElement($competitionId);

        return $this;
    }

    /**
     * @return Collection<int, sport>
     */
    public function getSportId(): Collection
    {
        return $this->sport_id;
    }

    public function addSportId(sport $sportId): static
    {
        if (!$this->sport_id->contains($sportId)) {
            $this->sport_id->add($sportId);
        }

        return $this;
    }

    public function removeSportId(sport $sportId): static
    {
        $this->sport_id->removeElement($sportId);

        return $this;
    }
}
