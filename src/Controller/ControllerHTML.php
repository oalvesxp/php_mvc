<?php 

namespace Alura\Mvc\Controller;

abstract class ControllerHTML implements Controller
{
    private const TEMPLATE_PATH = __DIR__ . '/../../views/';
    protected function renderTemplate(string $name, array $context = []): string
    {
        extract($context);
        /** Inicializa um buffer de saida */
        ob_start();
        require_once  self::TEMPLATE_PATH . $name;
        /** Entrega o conteúdo do buffer */
        /** Limpa o buffer */
        return ob_get_clean();
    }
}
