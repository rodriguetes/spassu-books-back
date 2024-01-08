<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\ChatGPTController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return response()->json(['message' => 'OK']);
});

Route::apiResource('livro', LivroController::class);
Route::apiResource('autor', AutorController::class);
Route::apiResource('assunto', AssuntoController::class);

Route::get('gerarRelatorio', [ViewController::class, 'gerarRelatorio']);
Route::post('sugestaoLivro', [ChatGPTController::class, 'sugestaoLivro']);
