<?php

namespace App\Entity;

use App\Repository\ChampionshipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionshipRepository::class)]
class Championship
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?sport $sport_id = null;

    /**
     * @var Collection<int, Competition>
     */
    #[ORM\OneToMany(targetEntity: Competition::class, mappedBy: 'championship_id')]
    private Collection $competitions;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
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

    public function getSportId(): ?sport
    {
        return $this->sport_id;
    }

    public function setSportId(sport $sport_id): static
    {
        $this->sport_id = $sport_id;

        return $this;
    }

    /**
     * @return Collection<int, Competition>
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setChampionshipId($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            // set the owning side to null (unless already changed)
            if ($competition->getChampionshipId() === $this) {
                $competition->setChampionshipId(null);
            }
        }

        return $this;
    }
}
