<?php

namespace App\Entity\Abstract;

use App\Entity\Enum\Status;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\MappedSuperclass;

#[MappedSuperclass]
abstract class Sport
{
    #[Column(type: "string", length: 255)]
    private string $name;

    #[Column(type: "integer")]
    private int $duration;

    #[Column(type: 'string', enumType: Status::class)]
    private Status $status = Status::PLANNED;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Sport
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     * @return Sport
     */
    public function setDuration(int $duration): self
    {
        $this->duration = $duration;
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
     * @return Sport
     */
    public function setStatus(Status $status): self
    {
        $this->status = $status;
        return $this;
    }


}
