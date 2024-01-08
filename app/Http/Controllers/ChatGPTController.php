<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatGPTController extends Controller
{
    public function sugestaoLivro(Request $request)
    {
        $client = new Client();

        try {
             $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                 'headers' => [
                     'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                     'Content-Type' => 'application/json',
                 ],
                 'json' => [
                     'model' => 'gpt-3.5-turbo-1106',
                     'messages' => [
                         [
                             'role' => 'user',
                             'content' => 'Me de uma sugestao de um titulo de livro no maximo de 40 caracteres no seguinte assunto: ' . $request->input('assunto'),
                         ],
                     ],
                     'temperature' => 0.7
                 ]
             ]);

            $body = json_decode($response->getBody(), true);
            return response()->json($body['choices'][0]['message']['content']);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
