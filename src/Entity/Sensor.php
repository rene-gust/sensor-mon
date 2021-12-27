<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SensorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SensorRepository::class)
 */
class Sensor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=SensorRecord::class, mappedBy="sensor", orphanRemoval=true)
     */
    private $sensorRecords;

    public function __construct()
    {
        $this->sensorRecords = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|SensorRecord[]
     */
    public function getSensorRecords(): Collection
    {
        return $this->sensorRecords;
    }

    public function addSensorRecord(SensorRecord $sensorRecord): self
    {
        if (!$this->sensorRecords->contains($sensorRecord)) {
            $this->sensorRecords[] = $sensorRecord;
            $sensorRecord->setSensor($this);
        }

        return $this;
    }

    public function removeSensorRecord(SensorRecord $sensorRecord): self
    {
        if ($this->sensorRecords->removeElement($sensorRecord)) {
            // set the owning side to null (unless already changed)
            if ($sensorRecord->getSensor() === $this) {
                $sensorRecord->setSensor(null);
            }
        }

        return $this;
    }
}
