<?php

namespace App\Service;

use App\Entity\Tariff;

class Calculator
{
    /**
     * @param int $totalDistance
     * @param array|Tariff[] $tariffs
     * @return float|int
     */
    public function calcCost(int $totalDistance, array $tariffs): float
    {
        $totalCost = 0;
        foreach ($tariffs as $tariffArray) {
            if ($totalDistance > $tariffArray->getMaxDistance() && $tariffArray->getMaxDistance() !== null) {
                $totalCost += $tariffArray->getCost() * ($tariffArray->getMaxDistance() - $tariffArray->getMinDistance() + 1);
            } else {
                $totalCost += $tariffArray->getCost() * ($totalDistance - $tariffArray->getMinDistance() + 1);
            }

            if ($totalDistance <= $tariffArray->getMaxDistance()) {
                break;
            }
        }
        return $totalCost;
    }
}