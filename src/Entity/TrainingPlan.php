<?php

namespace App\Entity;

use App\Repository\TrainingPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingPlanRepository::class)]
class TrainingPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'date')]
    private $startDate;

    #[ORM\Column(type: 'date')]
    private $endDate;

    #[ORM\Column(type: 'integer')]
    private $duration;

    #[ORM\OneToMany(mappedBy: 'trainingPlan', targetEntity: SportSession::class)]
    private $sportSessions;

    public function __construct()
    {
        $this->sportSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection<int, SportSession>
     */
    public function getSportSessions(): Collection
    {
        return $this->sportSessions;
    }

    public function addSportSession(SportSession $sportSession): self
    {
        if (!$this->sportSessions->contains($sportSession)) {
            $this->sportSessions[] = $sportSession;
            $sportSession->setTrainingPlan($this);
        }

        return $this;
    }

    public function removeSportSession(SportSession $sportSession): self
    {
        if ($this->sportSessions->removeElement($sportSession)) {
            // set the owning side to null (unless already changed)
            if ($sportSession->getTrainingPlan() === $this) {
                $sportSession->setTrainingPlan(null);
            }
        }

        return $this;
    }
}
