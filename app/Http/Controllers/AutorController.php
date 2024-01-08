<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Traits\ApiResponseTrait;

use App\Exceptions\Autor\AutorDeleteException;
use App\Exceptions\Autor\AutorSaveException;
use App\Exceptions\Autor\AutorUpdateException;
use App\Exceptions\Autor\AutorNotFoundException;

use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;

use App\Http\Services\AutorService;
use App\Http\Resources\AutorResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AutorController extends Controller
{
    use ApiResponseTrait;
    protected AutorService $autorService;

    public function __construct(AutorService $autorService)
    {
        $this->autorService = $autorService;
    }

    /**
     * Lista todos os autores.
     * @return AnonymousResourceCollection
     * @throws AutorNotFoundException
     */
    public function index(Request $request)
    {
        $allAutores = $this->autorService->allAutores($request);
        return AutorResource::collection($allAutores);
    }

    /**
     * Salva um novo autor.
     * @param StoreAutorRequest $request
     * @return JsonResponse
     * @throws AutorSaveException
     */
    public function store(StoreAutorRequest $request): JsonResponse
    {
        $autorResult = $this->autorService->storeAutor($request->validated());
        return $this->jsonResponse(
            true,
            AutorResource::make($autorResult),
            'Autor Cadastrado com Sucesso.',
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * Mostra um autor específico.
     * @param int $id
     * @return JsonResponse
     * @throws AutorNotFoundException
     */
    public function show(int $id)
    {
        $autor = $this->autorService->findAutor($id);
        return $this->jsonResponse(
            true,
            AutorResource::make($autor)
        );
    }

    /**
     * Atualiza um autor existente.
     * @param UpdateAutorRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws AutorUpdateException|AutorNotFoundException
     */
    public function update(UpdateAutorRequest $request, int $id)
    {
        $autor = $this->autorService->updateAutor($request->validated(), $id);
        if (isset($autor)) {
            return $this->jsonResponse(
                true,
                $this->autorService->findAutor($id),
                'Autor atualizado com sucesso.'
            );
        }
    }

    /**
     * Deleta um autor específico.
     * @param int $id
     * @return JsonResponse
     * @throws AutorDeleteException
     */
    public function destroy(int $id)
    {
        $autorDeletado = $this->autorService->destroyAutor($id);

        if (!$autorDeletado) {
            return $this->jsonResponse(
                false,
                null,
                'Existem livros atribuídos a essse Autor.',
                ResponseAlias::HTTP_BAD_REQUEST
            );
        }

        return $this->jsonResponse(
            true,
            null,
            'Autor deletado com sucesso.',
            ResponseAlias::HTTP_OK
        );
    }
}
