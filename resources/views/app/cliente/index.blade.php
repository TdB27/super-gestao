@extends('app.layouts.basico')

@section('titulo', 'Cliente')

@section('conteudo')

<div class="conteudo-pagina">

    <div class="titulo-pagina-2">
        <p>Listagem de Cliente</p>
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ route('cliente.create') }}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informacao-pagina">
        <div style="width: 90%; margin: 40px auto 0">
            <table border="1" width="100%">
                <thead>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>

                        <td>
                            <a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">
                                Visualizar
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">
                                Editar
                            </a>
                        </td>
                        <td>
                            <form id="form_{{ $cliente->id }}" action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <a href="#" onclick="document.getElementById('form_{{ $cliente->id }}').submit()"> Excluir </a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $clientes->appends($request)->links() }}
            <br>
            Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} (de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }})
        </div>
    </div>

</div>

@endsection