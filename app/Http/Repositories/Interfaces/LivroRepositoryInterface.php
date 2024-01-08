<?php

namespace App\Http\Repositories\Interfaces;

Interface LivroRepositoryInterface {
    public function allLivros();
    public function storeLivro($data);
    public function findLivro($id);
    public function updateLivro($data, $id);
    public function destroyLivro($id);
}
