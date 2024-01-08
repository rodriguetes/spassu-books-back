<?php

namespace App\Http\Repositories\Interfaces;

Interface AutorRepositoryInterface {
    public function allAutores($request);
    public function storeAutor($data);
    public function findAutor($id);
    public function updateAutor($data, $id);
    public function destroyAutor($id);
}
