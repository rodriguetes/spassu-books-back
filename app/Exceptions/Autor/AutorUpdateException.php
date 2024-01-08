<?php

namespace App\Exceptions\Autor;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AutorUpdateException extends Exception
{
    public function render()
    {
        return response()->json(
            ["success" => false, "message" => "Erro ao atualizar Autor: " . $this->getMessage()],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
