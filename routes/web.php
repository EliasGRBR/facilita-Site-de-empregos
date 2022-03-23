<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\DetalhesEmpresaController;
use App\Http\Controllers\VagaController;


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

Route::get('/', [App\Http\Controllers\VagaController::class, 'index']);
Route::get('/showvaga/{id}', [App\Http\Controllers\VagaController::class, 'show']);

Auth::routes();
// Rota para o após login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');
// rotas do canditato
Route::get('/candidato', [App\Http\Controllers\CandidatoController::class, 'index'])->middleware('auth','isCandidato');
Route::post('/curriculo/create', [App\Http\Controllers\CurriculoController::class, 'store'])->middleware('auth','isCandidato');
Route::get('/curriculo/create', [App\Http\Controllers\CandidatoController::class, 'index'])->middleware('auth','isCandidato');
Route::put('/edit/update/{id}', [App\Http\Controllers\CandidatoController::class, 'update'])->middleware('auth','isCandidato');
Route::put('/edit/update/curriculo/{id}', [App\Http\Controllers\CurriculoController::class, 'update'])->middleware('auth','isCandidato');
// Rotas da empresa
Route::get('/empresa', [App\Http\Controllers\EmpresaController::class, 'index'])->middleware('auth','isEmpresa');
Route::put('/edit/update/empresa/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->middleware('auth','isEmpresa');
Route::post('/detalhes/create', [App\Http\Controllers\DetalhesEmpresaController::class, 'store'])->middleware('auth','isEmpresa');
Route::get('/detalhes/create', [App\Http\Controllers\EmpresaController::class, 'index'])->middleware('auth','isEmpresa');
Route::put('/edit/update/detalhes/{id}', [App\Http\Controllers\DetalhesEmpresaController::class, 'update'])->middleware('auth','isEmpresa');
// Rotas da Vaga
Route::post('/new/vaga', [App\Http\Controllers\VagaController::class, 'store'])->middleware('auth','isEmpresa');
Route::delete('delete/vaga/{id}', [App\Http\Controllers\VagaController::class, 'destroy'])->middleware('auth','isEmpresa');
Route::get('delete/vaga/{id}', [App\Http\Controllers\EmpresaController::class, 'index'])->middleware('auth','isEmpresa');
Route::post('/candidatar/{id}', [App\Http\Controllers\VagaController::class, 'joinVaga'])->middleware('auth','isCandidato');
Route::get('vaga/candidatos/{id}', [App\Http\Controllers\VagaController::class, 'showCandidatos'])->middleware('auth','isEmpresa');
Route::post('vaga/mudarstatus/{id}', [App\Http\Controllers\VagaController::class, 'mudarStatus'])->middleware('auth','isEmpresa');
Route::post('/deixarvaga/{id}', [App\Http\Controllers\VagaController::class, 'leaveVaga'])->middleware('auth','isCandidato');







