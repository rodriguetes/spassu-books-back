<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'editora' => $this->editora,
            'edicao' => $this->edicao,
            'anoPublicacao' => $this->ano_publicacao,
            'valor' => $this->valor,
            'autores' => AutorResource::collection($this->whenLoaded('autores')),
            'assuntos' => AssuntoResource::collection($this->whenLoaded('assuntos'))
        ];
    }
}
