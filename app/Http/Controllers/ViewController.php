<?php

namespace App\Http\Controllers;

use App\Models\View;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ViewController extends Controller
{
    public function gerarRelatorio(Request $request)
    {
        $relatorio = View::query()
            ->select("*")
            ->get()
            ->toArray();

        $newRelatorio = [];
        if (count($relatorio) > 0) {
            foreach ($relatorio as $key => $value) {
                $newRelatorio[$value['autor_nome']][] = $value;
            }
        }

        $pdf = PDF::loadView('view', [
            'relatorio' => $newRelatorio,
        ]);

        return $pdf->download('Relatorio.pdf');
    }
}
