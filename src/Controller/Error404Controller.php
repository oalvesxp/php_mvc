<?php

namespace Alura\Mvc\Controller;

class Error404Controller implements Controller
{
    public function processRequest(): void
    {
        require_once __DIR__ . '/../../_header.php'; ?>
            <style>
                .container__error {
                    margin: 3em 0;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    text-align: initial;
                }

                .error__titulo {
                    color: var(--azul-medio);
                    font-weight: bold;
                    font-size: 32px;
                    margin-bottom: 20px;
                }

                .error__mensagem {
                    color: var(--azul-escuro);
                    font-weight: regular;
                    font-size: 24px;
                }

            </style>

            <main class="container">
                <div class="container__error">
                    <h2 class="error__titulo">Error 404</h2>      
                    <p class="error__mensagem">Desculpe... Não foi possível encontrar "<?= $_SERVER['PATH_INFO']?>".</p>
                </div>
            </main>
        <?php require_once __DIR__ . '/../../_footer.php';

    }
}
