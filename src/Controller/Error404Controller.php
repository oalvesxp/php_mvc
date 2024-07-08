<?php

namespace Alura\Mvc\Controller;

class Error404Controller extends ControllerHTML implements Controller
{
    public function processRequest(): void
    {
        echo $this->renderTemplate('error-404.php');
    }
}
