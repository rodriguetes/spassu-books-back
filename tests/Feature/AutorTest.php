<?php

namespace Tests\Feature;

use App\Models\Autor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AutorTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_createAutor()
    {
        $autorData = [
            'nome' => 'Autor de Teste'
        ];

        $this
            ->json('POST', route('autor.store'), $autorData, ['Accept' => 'application/json'])
            ->assertStatus(ResponseAlias::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'nome' => 'Autor de Teste'
                ]
            ]);
    }

    public function test_showAutor()
    {
        $autor = new Autor(['nome' => 'Autor Exemplo']);
        $autor->save();

        $this
            ->getJson(route('autor.show', ['autor' => $autor->id]))
            ->assertStatus(ResponseAlias::HTTP_OK)
            ->assertJson([
                'data' => [
                    'nome' => 'Autor Exemplo'
                ]
            ]);
    }

    public function test_autorNotFound()
    {
        $this
            ->getJson(route('autor.show', ['autor' => 999]))
            ->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }

    public function test_deleteAutor()
    {
        $autor = new Autor(['nome' => 'Autor para Deletar']);
        $autor->save();

        $this
            ->deleteJson(route('autor.destroy', ['autor' => $autor->id]))
            ->assertStatus(ResponseAlias::HTTP_OK);
    }

    public function test_deleteAutorNotExists()
    {
        $this
            ->deleteJson(route('autor.destroy', ['autor' => 999]))
            ->assertStatus(ResponseAlias::HTTP_NOT_FOUND);
    }
}
