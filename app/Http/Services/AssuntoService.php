<?php

namespace App\Http\Services;

use Illuminate\Database\QueryException;

use App\Exceptions\Assunto\AssuntoSaveException;
use App\Exceptions\Assunto\AssuntoUpdateException;
use App\Exceptions\Assunto\AssuntoDeleteException;
use App\Exceptions\Assunto\AssuntoNotFoundException;

use App\Http\Repositories\Interfaces\AssuntoRepositoryInterface;

class AssuntoService
{
    protected AssuntoRepositoryInterface $interface;

    public function __construct(AssuntoRepositoryInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * @throws AssuntoNotFoundException
     */
    public function allAssuntos($request)
    {
        try {
            return $this->interface->allAssuntos($request);
        } catch (QueryException $e) {
            throw new AssuntoNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws AssuntoSaveException
     */
    public function storeAssunto($data)
    {
        try {
            return $this->interface->storeAssunto($data);
        } catch (QueryException $e) {
            throw new AssuntoSaveException($e->getMessage());
        }
    }

    /**
     * @throws AssuntoNotFoundException
     */
    public function findAssunto($id)
    {
        try {
            return $this->interface->findAssunto($id);
        } catch (QueryException $e) {
            throw new AssuntoNotFoundException($e->getMessage());
        }
    }

    /**
     * @throws AssuntoUpdateException
     */
    public function updateAssunto($data, $id)
    {
        try {
            return $this->interface->updateAssunto($data, $id);
        } catch (QueryException $e) {
            throw new AssuntoUpdateException($e->getMessage());
        }
    }

    /**
     * @throws AssuntoDeleteException
     */
    public function destroyAssunto($id)
    {
        try {
            return $this->interface->destroyAssunto($id);
        } catch (QueryException $e) {
            throw new AssuntoDeleteException($e->getMessage());
        }
    }

}
