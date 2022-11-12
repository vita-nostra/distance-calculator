<?php

namespace App\Service;

use App\Entity\Tariff;

class TariffsManager
{
    /**
     * @var array|Tariff[]
     */
    private array $tariffs;

    /**
     * @return array|Tariff[]
     */
    public function getTariffs(): array
    {
        return $this->tariffs;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function loadTariffs(): void
    {
        $json = file_get_contents('./tariffs.json');
        $tariffsArray = json_decode($json, true);
        $this->checkTariffs($tariffsArray);
        foreach ($tariffsArray as $tariffArray) {
            $this->tariffs[] = new Tariff($tariffArray["minDistance"], $tariffArray["maxDistance"], $tariffArray["cost"]);
        }
    }

    /**
     * @param array $tariffs
     * @return void
     * @throws \Exception
     */
    private function checkTariffs(Array $tariffs): void
    {
        $previousMaxDistance = null;
        foreach ($tariffs as $tariff)
        {
            if ($previousMaxDistance !== null && $previousMaxDistance + 1 !== $tariff["minDistance"]) {
                throw new \Exception("Неверно заданы тарифы: интервалы дистанций не должны пересекаться или иметь незаданные интервалы");
            }
            if ($tariff["minDistance"] >= $tariff["maxDistance"] && $tariff["maxDistance"] !== null) {
                throw new \Exception("Неверно заданы тарифы: Минимальная граница интервала должна быть меньше максимальной");
            }
            $previousMaxDistance = $tariff["maxDistance"];
        }
    }
}