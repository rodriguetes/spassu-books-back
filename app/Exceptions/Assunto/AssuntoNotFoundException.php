<?php

namespace App\Exceptions\Assunto;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssuntoNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(
            ["success" => false, "message" => "Assunto não encontrado: " . $this->getMessage()],
            ResponseAlias::HTTP_NOT_FOUND
        );
    }
}
