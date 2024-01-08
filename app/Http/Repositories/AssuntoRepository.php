<?php

namespace App\Http\Repositories;

use App\Models\Assunto;
use App\Http\Repositories\Interfaces\AssuntoRepositoryInterface;

class AssuntoRepository implements AssuntoRepositoryInterface
{

    public function allAssuntos($request)
    {
        $paginate = $request->query('paginate', true);
        $paginate = filter_var($paginate, FILTER_VALIDATE_BOOLEAN);

        if ($paginate) {
            return Assunto::latest()->paginate(10);
        } else {
            return Assunto::latest()->get();
        }
    }

    public function storeAssunto($data)
    {
        return Assunto::create($data);
    }

    public function findAssunto($id)
    {
        return Assunto::findOrFail($id);
    }

    public function updateAssunto($data, $id)
    {
        $assunto = Assunto::findOrFail($id);
        $assunto->update($data);
        return $assunto;
    }

    public function destroyAssunto($id)
    {
        $assunto = Assunto::findOrFail($id);
        $assunto->delete();
        return $assunto;
    }

}
