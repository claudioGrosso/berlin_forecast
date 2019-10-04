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
    private $phrase;

    /**
     * @ORM\Column(type="boolean")
     */
    private $precipitation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $precipitationType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intensity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DailyForecast", inversedBy="dayWeather")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dailyForecast;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrecipitationType(): ?string
    {
        return $this->precipitationType;
    }

    public function setPrecipitationType(?string $precipitationType): self
    {
        $this->precipitationType = $precipitationType;

        return $this;
    }

    public function getIntensity(): ?string
    {
        return $this->intensity;
    }

    public function setIntensity(?string $intensity): self
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
