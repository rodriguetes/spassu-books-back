<?php

namespace App\Exceptions\Livro;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LivroSaveException extends Exception
{
    public function render($request)
    {
        return response()->json(
            ["success" => false, "message" => "Erro ao salvar Livro: " . $this->getMessage()],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
