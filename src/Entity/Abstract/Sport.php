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
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
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
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }


}
