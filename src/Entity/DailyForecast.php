<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DailyForecastRepository")
 */
class DailyForecast
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $min;

    /**
     * @ORM\Column(type="integer")
     */
    private $max;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $day;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $night;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\forecast")
     * @ORM\JoinColumn(nullable=false)
     */
    private $forecastId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(?string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getNight(): ?string
    {
        return $this->night;
    }

    public function setNight(?string $night): self
    {
        $this->night = $night;

        return $this;
    }

    public function getForecastId(): ?forecast
    {
        return $this->forecastId;
    }

    public function setForecastId(?forecast $forecastId): self
    {
        $this->forecastId = $forecastId;

        return $this;
    }
}
