<?php

namespace App\Service;

class TemplateManager
{
    private const TEMPLATE_BASE_PATH = __DIR__ . "/../Views";

    public function render(string $template, array $data = []): string
    {
        ob_start();
        extract($data);
        include self::TEMPLATE_BASE_PATH . "/" . $template;
        return ob_get_clean();
    }
}