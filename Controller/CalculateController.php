<?php

namespace App\Controller;

use App\Service\Calculator;
use App\Service\TariffsManager;
use App\Service\TemplateManager;
use Exception;

class CalculateController
{
    private Calculator $calculator;
    private TariffsManager $tariffsManager;
    private TemplateManager $templateManager;

    public function __construct(Calculator $calculator, TariffsManager $tariffsManager, TemplateManager $templateManager)
    {
        $this->calculator = $calculator;
        $this->tariffsManager = $tariffsManager;
        $this->templateManager = $templateManager;

    }

    public function __invoke(): void
    {
        try {
            $this->tariffsManager->loadTariffs();
        } catch (Exception $e) {
            echo $this->templateManager->render("Calculator.php", [
                "error" => $e->getMessage()
            ]);
            return;
        }

        if (empty($_POST)) {
            echo $this->templateManager->render("Calculator.php");
            return;
        }

        $totalDistance = $_POST["total_distance"];
        try {
            $this->validateDistance($totalDistance);
        } catch (Exception $e) {
            echo $this->templateManager->render("Calculator.php", [
                "error" => $e->getMessage()
            ]);
            return;
        }

        $cost = $this->calculator->calcCost($totalDistance, $this->tariffsManager->getTariffs());
        echo $this->templateManager->render("Calculator.php", [
            "result" => $cost
        ]);
    }

    /**
     * @throws Exception
     */
    private function validateDistance($distance): void
    {
        if (!ctype_digit($distance)) {
            throw new \Exception("Значение расстояния должно быть целым числом");
        }
        if ($distance <= 0) {
            throw new \Exception("Значение расстояния должно быть больше нуля");
        }
    }

}