<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\ApiResponseTrait;

use App\Exceptions\Assunto\AssuntoDeleteException;
use App\Exceptions\Assunto\AssuntoSaveException;
use App\Exceptions\Assunto\AssuntoUpdateException;
use App\Exceptions\Assunto\AssuntoNotFoundException;

use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;

use App\Http\Services\AssuntoService;
use App\Http\Resources\AssuntoResource;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssuntoController extends Controller
{
    use ApiResponseTrait;
    protected AssuntoService $assuntoService;

    public function __construct(AssuntoService $assuntoService)
    {
        $this->assuntoService = $assuntoService;
    }

    /**
     * Lista todos os assuntos.
     * @return AnonymousResourceCollection
     * @throws AssuntoNotFoundException
     */
    public function index(Request $request)
    {
        $allAssuntos = $this->assuntoService->allAssuntos($request);
        return AssuntoResource::collection($allAssuntos);
    }

    /**
     * Salva um novo assunto.
     * @param StoreAssuntoRequest $request
     * @return JsonResponse
     * @throws AssuntoSaveException
     */
    public function store(StoreAssuntoRequest $request): JsonResponse
    {
        $assuntoResult = $this->assuntoService->storeAssunto($request->validated());
        return $this->jsonResponse(
            true,
            AssuntoResource::make($assuntoResult),
            'Assunto Cadastrado com Sucesso.',
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * Mostra um assunto específico.
     * @param int $id
     * @return JsonResponse
     * @throws AssuntoNotFoundException
     */
    public function show(int $id)
    {
        $assunto = $this->assuntoService->findAssunto($id);
        return $this->jsonResponse(
            true,
            AssuntoResource::make($assunto)
        );
    }

    /**
     * Atualiza um assunto existente.
     * @param UpdateAssuntoRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws AssuntoUpdateException|AssuntoNotFoundException
     */
    public function update(UpdateAssuntoRequest $request, int $id)
    {
        $assunto = $this->assuntoService->updateAssunto($request->validated(), $id);
        if (isset($assunto)) {
            return $this->jsonResponse(
                true,
                $this->assuntoService->findAssunto($id),
                'Assunto atualizado com sucesso.'
            );
        }
    }

    /**
     * Deleta um assunto específico.
     * @param int $id
     * @return JsonResponse
     * @throws AssuntoDeleteException
     */
    public function destroy(int $id)
    {
        $assuntoDeletado = $this->assuntoService->destroyAssunto($id);

        if (!$assuntoDeletado) {
            return $this->jsonResponse(
                false,
                null,
                'Existem livros atribuídos a essse Assunto.',
                ResponseAlias::HTTP_BAD_REQUEST
            );
        }

        return $this->jsonResponse(
            true,
            null,
            'Assunto deletado com sucesso.',
            ResponseAlias::HTTP_OK
        );
    }
}
