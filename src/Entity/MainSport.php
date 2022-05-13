<?php

namespace App\Entity;

use App\Entity\Abstract\Sport;
use App\Entity\Enum\MainType;
use App\Entity\Enum\Tag;
use App\Repository\MainSportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainSportRepository::class)]
class MainSport extends Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private int $distance;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $elevationGain;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $elevationLoss;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $location;

    #[ORM\Column(type: 'string', nullable: true, enumType: Tag::class)]
    private Tag $tag;

    #[ORM\Column(type: 'string', enumType: MainType::class)]
    private MainType $type;

    #[ORM\ManyToOne(targetEntity: SportSession::class, inversedBy: 'mainSport')]
    #[ORM\JoinColumn(name: 'sport_session_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $sportSession;

    /**
     * @return MainType
     */
    public function getType(): MainType
    {
        return $this->type;
    }

    /**
     * @param MainType $type
     * @return MainSport
     */
    public function setType(MainType $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getElevationGain(): ?int
    {
        return $this->elevationGain;
    }

    public function setElevationGain(?int $elevationGain): self
    {
        $this->elevationGain = $elevationGain;

        return $this;
    }

    public function getElevationLoss(): ?int
    {
        return $this->elevationLoss;
    }

    public function setElevationLoss(?int $elevationLoss): self
    {
        $this->elevationLoss = $elevationLoss;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Tag
     */
    public function getTag(): Tag
    {
        return $this->tag;
    }

    /**
     * @param Tag $tag
     * @return MainSport
     */
    public function setTag(Tag $tag): self
    {
        $this->tag = $tag;
        return $this;
    }

    public function getSportSession(): ?SportSession
    {
        return $this->sportSession;
    }

    public function setSportSession(?SportSession $sportSession): self
    {
        $this->sportSession = $sportSession;

        return $this;
    }


}
