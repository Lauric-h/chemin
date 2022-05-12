<?php

namespace App\Entity;

use App\Entity\Enum\Status;
use App\Repository\TrainingPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;

#[AcmeAssert\IsValidStartDate]
#[ORM\Entity(repositoryClass: TrainingPlanRepository::class)]
class TrainingPlan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    private $name;

    #[ORM\Column(type: 'date')]
    #[Assert\NotBlank]
    #[Assert\Type(\DateTime::class)]
    private $startDate;

    #[ORM\Column(type: 'date')]
    #[Assert\Type(\DateTime::class)]
    private $endDate;

    #[ORM\Column(type: 'integer')]
    #[Assert\GreaterThan(0)]
    private $duration;

    #[ORM\OneToMany(mappedBy: 'trainingPlan', targetEntity: SportSession::class)]
    private $sportSessions;

    #[ORM\Column(type: 'boolean', options: [ "default" => false ])]
    private bool $isStarted = false;

    #[Column(type: 'string', enumType: Status::class, options: [ "default" => Status::PLANNED ])]
    private Status $status = Status::PLANNED;

    public function __construct()
    {
        $this->sportSessions = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
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
    public function getSportSessions(): ?Collection
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

    public function checkIsStarted(): void {
        if ($this->getStartDate() < new \DateTime('now') &&
            $this->getEndDate() > new \DateTime('now')) {
            $this->isStarted = true;

            $this->status = Status::IN_PROGRESS;
        }
    }

    function getIsStarted(): bool
    {
        return $this->isStarted;
    }

    public function setIsStarted(bool $isStarted): self
    {
        $this->isStarted = $isStarted;

        return $this;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return TrainingPlan
     */
    public function setStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }
}
