<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SensorRecordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SensorRecordRepository::class)
 */
class SensorRecord
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $sensorId;

    /**
     * @ORM\ManyToOne(targetEntity=Sensor::class, inversedBy="sensorRecords")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sensor;

    /**
     * @ORM\Column(type="float")
     */
    private $value;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity=SensorRecordUnit::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $unit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSensorId(): ?int
    {
        return $this->sensorId;
    }

    public function setSensorId(int $sensorId): self
    {
        $this->sensorId = $sensorId;

        return $this;
    }

    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    public function setSensor(?Sensor $sensor): self
    {
        $this->sensor = $sensor;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getDateTime(): ?\DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeImmutable $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getUnit(): ?SensorRecordUnit
    {
        return $this->unit;
    }

    public function setUnit(?SensorRecordUnit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }
}
