<?php

namespace App\Http\Traits;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponseTrait
{
    /**
     * Envia uma resposta JSON padronizada.
     *
     * @param bool $success Indica o sucesso da operação.
     * @param mixed $data Os dados a serem enviados na resposta.
     * @param string $message Uma mensagem opcional.
     * @param int $status Código de status HTTP.
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse($success, $data = null, $message = '', $status = ResponseAlias::HTTP_OK)
    {
        $response = ['success' => $success];

        if ($data !== null) {
            $response['data'] = $data;
        }

        if (!empty($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }
}
