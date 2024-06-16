<?php

namespace Alura\Mvc\Controller;

class Error404Controller implements Controller
{
    public function processRequest(): void
    {
        require_once __DIR__ . '/../../views/error-404.php';
    }
}
