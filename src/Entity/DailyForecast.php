<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="integer")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $minimum;

    /**
     * @ORM\Column(type="integer")
     */
    private $maximum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Forecast", inversedBy="dailyForecasts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $forecast;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Weather", mappedBy="dailyForecast", orphanRemoval=true)
     */
    private $dayWeather;

    public function __construct()
    {
        $this->dayWeather = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMinimum(): ?int
    {
        return $this->minimum;
    }

    public function setMinimum(int $minimum): self
    {
        $this->minimum = $minimum;

        return $this;
    }

    public function getMaximum(): ?int
    {
        return $this->maximum;
    }

    public function setMaximum(int $maximum): self
    {
        $this->maximum = $maximum;

        return $this;
    }

    public function getForecast(): ?Forecast
    {
        return $this->forecast;
    }

    public function setForecast(?Forecast $forecast): self
    {
        $this->forecast = $forecast;

        return $this;
    }

    /**
     * @return Collection|Weather[]
     */
    public function getDayWeather(): Collection
    {
        return $this->dayWeather;
    }

    public function addDayWeather(Weather $dayWeather): self
    {
        if (!$this->dayWeather->contains($dayWeather)) {
            $this->dayWeather[] = $dayWeather;
            $dayWeather->setDailyForecast($this);
        }

        return $this;
    }

    public function removeDayWeather(Weather $dayWeather): self
    {
        if ($this->dayWeather->contains($dayWeather)) {
            $this->dayWeather->removeElement($dayWeather);
            // set the owning side to null (unless already changed)
            if ($dayWeather->getDailyForecast() === $this) {
                $dayWeather->setDailyForecast(null);
            }
        }

        return $this;
    }
}
