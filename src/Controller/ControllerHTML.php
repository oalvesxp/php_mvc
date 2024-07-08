<?php 

namespace Alura\Mvc\Controller;

abstract class ControllerHTML implements Controller
{
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';
    protected function renderTemplate(string $name, array $context = []): void
    {
        extract($context);
        require_once  self::TEMPLATE_PATH . $name;
    }
}