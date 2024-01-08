<?php

namespace App\Exceptions\Livro;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LivroDeleteException extends Exception
{
    public function render()
    {
        return response()->json(
            ["success" => false, "message" => "Erro ao deletar Livro: " . $this->getMessage()],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
