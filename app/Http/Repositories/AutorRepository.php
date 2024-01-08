<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\AutorRepositoryInterface;
use App\Models\Autor;

class AutorRepository implements AutorRepositoryInterface
{

    public function allAutores($request)
    {
        $paginate = $request->query('paginate', true);
        $paginate = filter_var($paginate, FILTER_VALIDATE_BOOLEAN);

        if ($paginate) {
            return Autor::latest()->paginate(10);
        } else {
            return Autor::latest()->get();
        }
    }

    public function storeAutor($data)
    {
        return Autor::create($data);
    }

    public function findAutor($id)
    {
        return Autor::findOrFail($id);
    }

    public function updateAutor($data, $id)
    {
        $autor = Autor::findOrFail($id);
        $autor->update($data);
        return $autor;
    }

    public function destroyAutor($id)
    {
        $autor = Autor::findOrFail($id);
        $autor->delete();
        return $autor;
    }

}
