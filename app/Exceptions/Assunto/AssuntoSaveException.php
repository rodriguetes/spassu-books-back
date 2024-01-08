<?php

namespace App\Exceptions\Assunto;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssuntoSaveException extends Exception
{
    public function render($request)
    {
        return response()->json(
            ["success" => false, "message" => "Erro ao salvar Assunto: " . $this->getMessage()],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
