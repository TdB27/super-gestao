<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index', ['titulo' => "Fornecedor"]);
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
            ->paginate(5);

        return view('app.fornecedor.listar', [
            'titulo' => "Fornecedor",
            'fornecedores' => $fornecedores,
            'request' => $request->all()
        ]);
    }

    public function add(Request $request)
    {
        $msg = '';

        // inserção
        if ($request->input('_token') != '' && $request->input('id') == '') {
            // validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
            ];

            $feedbacks = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 3 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email' => 'O campo uf não foi preenchido corretamente',
            ];

            $request->validate($regras, $feedbacks);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //redirect

            //dados view
            $msg = 'Cadastro realizado com sucesso';
        }

        // edição
        if ($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));

            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'Atualização realizado com sucesso!';
            } else {
                $msg = 'Atualização apresentou problema!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', [
            'titulo' => "Fornecedor",
            'msg' => $msg,
        ]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', [
            'titulo' => "Fornecedor",
            'fornecedor' => $fornecedor,
            'msg' => $msg
        ]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        // Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor');
    }
}
