<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForecastRepository")
 */
class Forecast
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
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DailyForecast", mappedBy="forecast", orphanRemoval=true)
     */
    private $dailyForecasts;

    public function __construct()
    {
        $this->dailyForecasts = new ArrayCollection();
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection|DailyForecast[]
     */
    public function getDailyForecasts(): Collection
    {
        return $this->dailyForecasts;
    }

    public function addDailyForecast(DailyForecast $dailyForecast): self
    {
        if (!$this->dailyForecasts->contains($dailyForecast)) {
            $this->dailyForecasts[] = $dailyForecast;
            $dailyForecast->setForecast($this);
        }

        return $this;
    }

    public function removeDailyForecast(DailyForecast $dailyForecast): self
    {
        if ($this->dailyForecasts->contains($dailyForecast)) {
            $this->dailyForecasts->removeElement($dailyForecast);
            // set the owning side to null (unless already changed)
            if ($dailyForecast->getForecast() === $this) {
                $dailyForecast->setForecast(null);
            }
        }

        return $this;
    }
}
