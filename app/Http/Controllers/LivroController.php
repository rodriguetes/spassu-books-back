<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Http\Traits\ApiResponseTrait;

use App\Exceptions\Livro\LivroDeleteException;
use App\Exceptions\Livro\LivroSaveException;
use App\Exceptions\Livro\LivroUpdateException;
use App\Exceptions\Livro\LivroNotFoundException;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;

use App\Http\Services\LivroService;
use App\Http\Resources\LivroResource;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LivroController extends Controller
{
    use ApiResponseTrait;
    protected LivroService $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    /**
     * Lista todos os livros.
     * @return AnonymousResourceCollection
     * @throws LivroNotFoundException
     */
    public function index()
    {
        $allLivros = $this->livroService->allLivros();
        return LivroResource::collection($allLivros);
    }

    /**
     * Salva um novo livro.
     * @param StoreLivroRequest $request
     * @return JsonResponse
     * @throws LivroSaveException
     */
    public function store(StoreLivroRequest $request): JsonResponse
    {
        $livroResult = $this->livroService->storeLivro($request->validated());
        return $this->jsonResponse(
            true,
            LivroResource::make($livroResult),
            'Livro Cadastrado com Sucesso.',
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * Mostra um livro específico.
     * @param int $id
     * @return JsonResponse
     * @throws LivroNotFoundException
     */
    public function show(int $id)
    {
        $livro = $this->livroService->findLivro($id);
//        dd($livro);
        return $this->jsonResponse(
            true,
            LivroResource::make($livro)
        );
    }

    /**
     * Atualiza um livro existente.
     * @param UpdateLivroRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws LivroUpdateException|LivroNotFoundException
     */
    public function update(UpdateLivroRequest $request, int $id)
    {
        $livro = $this->livroService->updateLivro($request->validated(), $id);
        if (isset($livro)) {
            return $this->jsonResponse(
                true,
                $this->livroService->findLivro($id),
                'Livro atualizado com sucesso.'
            );
        }
    }

    /**
     * Deleta um livro específico.
     * @param int $id
     * @return JsonResponse
     * @throws LivroDeleteException
     */
    public function destroy(int $id)
    {
        $this->livroService->destroyLivro($id);
        return $this->jsonResponse(
            true,
            null,
            'Livro deletado com sucesso.',
            ResponseAlias::HTTP_OK
        );
    }
}
