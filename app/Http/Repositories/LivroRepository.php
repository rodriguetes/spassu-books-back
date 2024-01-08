<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\LivroRepositoryInterface;
use App\Models\Livro;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class LivroRepository implements LivroRepositoryInterface
{

    public function allLivros()
    {
        return Livro::latest()->paginate(10);
    }

    public function storeLivro($data)
    {
        $livro = Livro::create($data);

        if (isset($data['autores'])) {
            $livro->autores()->sync($data['autores']);
        }

        if (isset($data['assuntos'])) {
            $livro->assuntos()->sync($data['assuntos']);
        }

        $this->sendEmailBookCreate($livro);

        return $livro;
    }

    public function findLivro($id)
    {
        return Livro::with('autores', 'assuntos')->findOrFail($id);
    }

    public function updateLivro($data, $id)
    {
        $livro = Livro::findOrFail($id);
        $livro->update($data);
        return $livro;
    }

    public function destroyLivro($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();
        return $livro;
    }

    public function sendEmailBookCreate($livro)
    {
        $mensagemEmail = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .titulo { font-size: 16px; font-weight: bold; }
                    .detalhes { margin-top: 10px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <p>Com satisfação, confirmamos o cadastro de um novo livro em nosso sistema.</p>
                    <div class='detalhes'>
                        Título: {$livro->titulo}<br />
                        Editora: {$livro->editora}<br />
                        Edição: {$livro->edicao}<br />
                        Ano Publicação: {$livro->anoPublicacao}<br />
                        Valor: {$livro->valor}<br />
                    </div>
                    <p>Este é mais um passo importante para ampliar e diversificar nossa biblioteca.</p>
                </div>
            </body>
            </html>
        ";

        Mail::send([], [], function ($message) use ($mensagemEmail) {
            $message->to('rodriguetesr@gmail.com')
                ->subject('Novo Livro Adicionado ao Sistema')
                ->html($mensagemEmail); // set the body to HTML
        });

    }

}
