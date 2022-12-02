<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $r)
    {
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', [
            'titulo' => 'Contato',
            'motivo_contatos' => $motivo_contatos
        ]);
    }

    public function salvar(Request $r)
    {
        //  realizar a validação dos dados do formulário
        $r->validate([
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'required',
            'motivo_contato' => 'required',
            'mensagem' => 'required|max:2000',
        ]);

        // SiteContato::create($r->all());
    }
}
