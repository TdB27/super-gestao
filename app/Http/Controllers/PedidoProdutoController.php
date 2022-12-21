<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        $pedido->produtos; // eager loading
        return view('app.pedido_produto.create', [
            'pedido' => $pedido,
            'produtos' => $produtos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'required' => 'O campo :attribute deve possuir um valor válido'
        ];

        $request->validate($regras, $feedback);

        // ------------- MODO CONVENCIONAL
        // $pedidoProduto = new PedidoProduto();
        // $pedidoProduto->pedido_id = $pedido->id;
        // $pedidoProduto->produto_id = $request->get('produto_id');
        // $pedidoProduto->quantidade  = $request->get('quantidade');
        // $pedidoProduto->save();

        // ------------- MODO ATTACH
        // insere os dados na tabela relacional de modo dinâmico
        // $pedido->produtos // são os registros do relacionamento
        // $pedido->produtos() // é o obj
        $pedido->produtos()->attach(
            $request->get('produto_id'),
            ['quantidade' => $request->get('quantidade')]
        );
        // outra forma de se fazer isso
        // $pedido->produtos()->attach(
        //     [
        //         $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        //     ]
        // );

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido, Produto $produto)
    {
        print_r($pedido->getAttributes());
        echo '<hr>';
        print_r($produto->getAttributes());

        // ----------- MODO CONVENCIONAL
        // PedidoProduto::where([
        //     'pedido_id' => $pedido->id,
        //     'produto_id' => $produto->id,
        // ])->delete();

        // ----------- MODO DETACH
        // permite fazer a exclusão pelo relacionamento que foi implementado no MODEL
        $pedido->produtos()->detach($produto->id);
        // OU
        // $produto->pedidos()->detach($pedido->id);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }
}
