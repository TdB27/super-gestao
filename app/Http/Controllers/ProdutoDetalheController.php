<?php

namespace App\Http\Controllers;

use App\Models\ItemDetalhe;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoDetalheController extends Controller
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
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        ProdutoDetalhe::create($request->all());
        echo 'cadastro realizado com sucesso';
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
     * @param  \App\Models\ProdutoDetalhe $produtoDetalhe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // eager loading - faz o relacionamento ansioso... por padrão o lazy loading (carragemento tardio) faz o relacionamento somente quando o método for chamado
        $produtoDetalhe = ItemDetalhe::with(['item'])->find($id);
        $unidades = Unidade::all();
        return view('app.produto_detalhe.edit', ['produto_detalhe' => $produtoDetalhe, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdutoDetalhe $produtoDetalhe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        $produtoDetalhe->update($request->all());
        echo ' A atualização foi realizada com sucesso';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
