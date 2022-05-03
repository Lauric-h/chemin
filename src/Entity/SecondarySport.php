<?php

namespace App\Entity;

use App\Entity\Abstract\Sport;
use App\Entity\Enum\SecondaryType;
use App\Repository\SecondarySportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecondarySportRepository::class)]
class SecondarySport extends Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', enumType: SecondaryType::class)]
    private SecondaryType $type;

    #[ORM\ManyToOne(targetEntity: SportSession::class, inversedBy: 'secondarySport')]
    private $sportSession;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return SecondaryType
     */
    public function getType(): SecondaryType
    {
        return $this->type;
    }

    /**
     * @param SecondaryType $type
     * @return SecondarySport
     */
    public function setType(SecondaryType $type): self
    {
        $this->type = $type;
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
