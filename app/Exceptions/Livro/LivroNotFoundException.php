<?php

namespace App\Exceptions\Livro;
use Exception;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LivroNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(
            ["success" => false, "message" => "Livro não encontrado: " . $this->getMessage()],
            ResponseAlias::HTTP_NOT_FOUND
        );
    }
}
