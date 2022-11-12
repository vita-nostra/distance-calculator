<?php

namespace App\Entity;

class Tariff
{
    private int $minDistance;
    private ?int $maxDistance;
    private float $cost;

    public function __construct(int $minDistance, ?int $maxDistance, float $cost)
    {
        $this->minDistance = $minDistance;
        $this->maxDistance = $maxDistance;
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getMinDistance(): int
    {
        return $this->minDistance;
    }

    /**
     * @return int|null
     */
    public function getMaxDistance(): ?int
    {
        return $this->maxDistance;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

}