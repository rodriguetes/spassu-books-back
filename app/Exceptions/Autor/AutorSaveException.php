<?php

namespace App\Exceptions\Autor;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AutorSaveException extends Exception
{
    public function render($request)
    {
        return response()->json(
            ["success" => false, "message" => "Autor ao salvar Assunto: " . $this->getMessage()],
            ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
