<?php

namespace App\Http\Services;

use Illuminate\Database\QueryException;

use App\Exceptions\Livro\LivroSaveException;
use App\Exceptions\Livro\LivroUpdateException;
use App\Exceptions\Livro\LivroDeleteException;
use App\Exceptions\Livro\LivroNotFoundException;

use App\Http\Repositories\Interfaces\LivroRepositoryInterface;

class LivroService
{
    protected LivroRepositoryInterface $interface;

    public function __construct(LivroRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * @throws LivroNotFoundException
     */
    public function allLivros()
    {
        try {
            return $this->interface->allLivros();
        } catch (QueryException $e) {
            throw new LivroNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws LivroSaveException
     */
    public function storeLivro($data)
    {
        try {
            return $this->interface->storeLivro($data);
        } catch (QueryException $e) {
            throw new LivroSaveException($e->getMessage());
        }
    }

    /**
     * @throws LivroNotFoundException
     */
    public function findLivro($id)
    {
        try {
            return $this->interface->findLivro($id);
        } catch (QueryException $e) {
            throw new LivroNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws LivroUpdateException
     */
    public function updateLivro($data, $id)
    {
        try {
            return $this->interface->updateLivro($data, $id);
        } catch (QueryException $e) {
            throw new LivroUpdateException($e->getMessage());
        }
    }

    /**
     * @throws LivroDeleteException
     */
    public function destroyLivro($id)
    {
        try {
            return $this->interface->destroyLivro($id);
        } catch (QueryException $e) {
            throw new LivroDeleteException($e->getMessage());
        }
    }

}
