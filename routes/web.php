<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\TesteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PrincipalController::class, 'principal'])->name('site.index')->middleware('log.acesso');

Route::get('/sobre-nos', [SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [ContatoController::class, 'salvar'])->name('site.contato');

Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

Route::middleware('autenticacao:ldap,visitante')->prefix('/app')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('app.home');
    Route::get('/sair', [LoginController::class, 'sair'])->name('app.sair');

    Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::get('/fornecedor/lista', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::post('/fornecedor/lista', [FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/add', [FornecedorController::class, 'add'])->name('app.fornecedor.add');
    Route::post('/fornecedor/add', [FornecedorController::class, 'add'])->name('app.fornecedor.add');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');

    // produto
    Route::resource('produto', ProdutoController::class);
    // produtos detalhes
    Route::resource('produto-detalhe', ProdutoDetalheController::class);

    // cliente
    Route::resource('cliente', ClienteController::class);
    // pedido
    Route::resource('pedido', PedidoController::class);
    // pedido produto
    // Route::resource('pedido-produto', PedidoProdutoController::class);
    Route::get('pedido-produto/create/{pedido}', [PedidoProdutoController::class, 'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
    // Route::delete('pedido-produto/destroy/{pedido}/{produto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
    Route::delete('pedido-produto/destroy/{pedidoProduto}', [PedidoProdutoController::class, 'destroy'])->name('pedido-produto.destroy');
});

Route::get('/teste/{p1}/{p2}', [TesteController::class, 'teste'])->name('teste');

Route::fallback(function () {
    echo 'A rota acessada n??o existe. <a href="' . route('site.index') . '"> Clique aqui </a> para ir para a p??gina inicial';
});
