<?php

namespace App\Http\Repositories\Interfaces;

Interface AssuntoRepositoryInterface {
    public function allAssuntos($request);
    public function storeAssunto($data);
    public function findAssunto($id);
    public function updateAssunto($data, $id);
    public function destroyAssunto($id);
}
