@extends('app.layouts.basico')

@section('titulo', 'Pedido')

@section('conteudo')

<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Adicionar Produto</p>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informacao-pagina">
        {{ $msg ?? '' }}

        <div style="width: 30%; margin-left: auto; margin-right: auto">
            @component('app.pedido._components.form_create_edit', ['clientes'=> $clientes])
            @endcomponent
        </div>
    </div>

</div>

@endsection