<?php

namespace App\Entity;

use App\Repository\SportSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportSessionRepository::class)]
class SportSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $totalDuration;

    #[ORM\Column(type: 'integer')]
    private $totalDistance;

    #[ORM\Column(type: 'integer')]
    private $totalElevationGain;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $totalElevationLoss;

    #[ORM\Column(type: 'text', nullable: true)]
    private $notes;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\ManyToOne(targetEntity: TrainingPlan::class, inversedBy: 'sportSessions')]
    private $trainingPlan;

    #[ORM\OneToMany(mappedBy: 'sportSession', targetEntity: MainSport::class)]
    private $mainSport;

    #[ORM\OneToMany(mappedBy: 'sportSession', targetEntity: SecondarySport::class)]
    private $secondarySport;

    public function __construct()
    {
        $this->mainSport = new ArrayCollection();
        $this->secondarySport = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalDuration(): ?int
    {
        return $this->totalDuration;
    }

    public function setTotalDuration(int $totalDuration): self
    {
        $this->totalDuration = $totalDuration;

        return $this;
    }

    public function getTotalDistance(): ?int
    {
        return $this->totalDistance;
    }

    public function setTotalDistance(int $totalDistance): self
    {
        $this->totalDistance = $totalDistance;

        return $this;
    }

    public function getTotalElevationGain(): ?int
    {
        return $this->totalElevationGain;
    }

    public function setTotalElevationGain(int $totalElevationGain): self
    {
        $this->totalElevationGain = $totalElevationGain;

        return $this;
    }

    public function getTotalElevationLoss(): ?int
    {
        return $this->totalElevationLoss;
    }

    public function setTotalElevationLoss(?int $totalElevationLoss): self
    {
        $this->totalElevationLoss = $totalElevationLoss;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
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

    public function getTrainingPlan(): ?TrainingPlan
    {
        return $this->trainingPlan;
    }

    public function setTrainingPlan(?TrainingPlan $trainingPlan): self
    {
        $this->trainingPlan = $trainingPlan;

        return $this;
    }

    /**
     * @return Collection<int, MainSport>
     */
    public function getMainSport(): Collection
    {
        return $this->mainSport;
    }

    public function addMainSport(MainSport $mainSport): self
    {
        if (!$this->mainSport->contains($mainSport)) {
            $this->mainSport[] = $mainSport;
            $mainSport->setSportSession($this);
        }

        return $this;
    }

    public function removeMainSport(MainSport $mainSport): self
    {
        if ($this->mainSport->removeElement($mainSport)) {
            // set the owning side to null (unless already changed)
            if ($mainSport->getSportSession() === $this) {
                $mainSport->setSportSession(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SecondarySport>
     */
    public function getSecondarySport(): Collection
    {
        return $this->secondarySport;
    }

    public function addSecondarySport(SecondarySport $secondarySport): self
    {
        if (!$this->secondarySport->contains($secondarySport)) {
            $this->secondarySport[] = $secondarySport;
            $secondarySport->setSportSession($this);
        }

        return $this;
    }

    public function removeSecondarySport(SecondarySport $secondarySport): self
    {
        if ($this->secondarySport->removeElement($secondarySport)) {
            // set the owning side to null (unless already changed)
            if ($secondarySport->getSportSession() === $this) {
                $secondarySport->setSportSession(null);
            }
        }

        return $this;
    }
}
