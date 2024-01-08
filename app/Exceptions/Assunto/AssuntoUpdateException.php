<?php

namespace App\Exceptions\Assunto;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssuntoUpdateException extends Exception
{
    public function render()
    {
        return response()->json(
            ["success" => false, "message" => "Erro ao atualizar Assunto: " . $this->getMessage()],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
