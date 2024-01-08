<?php

namespace App\Http\Services;

use Illuminate\Database\QueryException;

use App\Exceptions\Autor\AutorSaveException;
use App\Exceptions\Autor\AutorUpdateException;
use App\Exceptions\Autor\AutorDeleteException;
use App\Exceptions\Autor\AutorNotFoundException;

use App\Http\Repositories\Interfaces\AutorRepositoryInterface;

class AutorService
{
    protected AutorRepositoryInterface $interface;

    public function __construct(AutorRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * @throws AutorNotFoundException
     */
    public function allAutores($request)
    {
        try {
            return $this->interface->allAutores($request);
        } catch (QueryException $e) {
            throw new AutorNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws AutorSaveException
     */
    public function storeAutor($data)
    {
        try {
            return $this->interface->storeAutor($data);
        } catch (QueryException $e) {
            throw new AutorSaveException($e->getMessage());
        }
    }

    /**
     * @throws AutorNotFoundException
     */
    public function findAutor($id)
    {
        try {
            return $this->interface->findAutor($id);
        } catch (QueryException $e) {
            throw new AutorNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws AutorUpdateException
     */
    public function updateAutor($data, $id)
    {
        try {
            return $this->interface->updateAutor($data, $id);
        } catch (QueryException $e) {
            throw new AutorUpdateException($e->getMessage());
        }
    }

    /**
     * @throws AutorDeleteException
     */
    public function destroyAutor($id)
    {
        try {
            return $this->interface->destroyAutor($id);
        } catch (QueryException $e) {
            throw new AutorDeleteException($e->getMessage());
        }
    }

}
