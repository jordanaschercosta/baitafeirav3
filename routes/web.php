<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessaoController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\BancaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ParticipacaoController;
use App\Http\Controllers\NotificacaoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [SessaoController::class, 'login'])->name('login')->middleware('logged');
Route::post('/login', [SessaoController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', [SessaoController::class, 'destroy'])->name('logout');

Route::get('/esqueci-a-senha', [SessaoController::class, 'forgetPassword'])->name('esqueci-a-senha');
Route::post('/esqueci-a-senha', [SessaoController::class, 'forgetPasswordAction'])->name('forgetPassword.submit');

Route::post('/salva-localizacao', [SessaoController::class, 'salvaLocalizacao'])->name('salva.localizacao');

Route::get('/resetar-senha/{id}', [CadastroController::class, 'resetPassword'])->name('resetar-senha');
Route::post('/resetar-senha', [CadastroController::class, 'resetPasswordAction'])->name('resetPassword.submit');

Route::get('/cadastro', [CadastroController::class, 'create'])->name('cadastro');
Route::post('/cadastro', [CadastroController::class, 'store'])->name('cadastro.store');

Route::get('/minha-conta', [CadastroController::class, 'edit'])->name('minha.conta');
Route::put('/minha-conta', [CadastroController::class, 'update'])->name('cadastro.update');

Route::resource('categorias', CategoriasController::class);

Route::get('/', [CategoriasController::class, 'index'])->name('home');

// Route::get('/notificacoes', [NotificacaoController::class, 'index']);
Route::get('/notificacoes/nao_lidas', [NotificacaoController::class, 'getNotificacoesNaoLidas']);

Route::middleware(['autorize'])->group(function () {
    Route::resource('favoritos', FavoritoController::class);
    Route::resource('notificacoes', NotificacaoController::class);

    Route::post('/favoritos', [FavoritoController::class, 'store'])->name('favoritos.store');
    Route::delete('favoritos/{favorito}', [FavoritoController::class, 'destroy'])->name('favoritos.destroy');

    Route::resource('bancas', BancaController::class);
    Route::resource('bancas.produtos', ProdutoController::class);
    Route::resource('eventos', EventoController::class);
    Route::resource('participacoes', ParticipacaoController::class);
});