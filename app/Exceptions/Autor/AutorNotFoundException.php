<?php

namespace App\Exceptions\Autor;

use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AutorNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(
            ["success" => false, "message" => "Autor não encontrado: " . $this->getMessage()],
            ResponseAlias::HTTP_NOT_FOUND
        );
    }
}
