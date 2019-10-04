<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WeatherRepository")
 */
class Weather
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
    private $light;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phrase;

    /**
     * @ORM\Column(type="boolean")
     */
    private $precipitation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intensity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DailyForecast", inversedBy="weather")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyForecast;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLight(): ?string
    {
        return $this->light;
    }

    public function setLight(string $light): self
    {
        $this->light = $light;

        return $this;
    }

    public function getPhrase(): ?string
    {
        return $this->phrase;
    }

    public function setPhrase(string $phrase): self
    {
        $this->phrase = $phrase;

        return $this;
    }

    public function getPrecipitation(): ?bool
    {
        return $this->precipitation;
    }

    public function setPrecipitation(bool $precipitation): self
    {
        $this->precipitation = $precipitation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIntensity(): ?string
    {
        return $this->intensity;
    }

    public function setIntensity(string $intensity): self
    {
        $this->intensity = $intensity;

        return $this;
    }

    public function getDailyForecast(): ?DailyForecast
    {
        return $this->dailyForecast;
    }

    public function setDailyForecast(?DailyForecast $dailyForecast): self
    {
        $this->dailyForecast = $dailyForecast;

        return $this;
    }
}
