<?php

use App\Http\Controllers\PDFC;
use App\Http\Livewire\Pages\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pages\Dashboard;
use App\Http\Livewire\Pages\Despeza\Create as DespezaCreate;
use App\Http\Livewire\Pages\Os\Lista as OSLista;
use App\Http\Livewire\Pages\Os\Create as OSCreate;
use App\Http\Livewire\Pages\Servico\TaxasVincular;
use App\Http\Livewire\Pages\Usuarios\Create as UserCreate;
use App\Http\Livewire\Pages\Usuarios\Update as UserUpdate;
use App\Http\Livewire\Pages\Cliente\Create as ClienteCreate;
use App\Http\Livewire\Pages\Cliente\Update as ClienteUpdate;
use App\Http\Livewire\Pages\Taxa\Dashboard as TaxaDashboard;
use App\Http\Livewire\Pages\Cliente\Dashboard as ClienteDashboard;
use App\Http\Livewire\Pages\Servico\Dashboard as ServicoDashboard;
use App\Http\Livewire\Pages\Usuarios\Dashboard as  UsuarioDashboard;
use App\Http\Livewire\Pages\Fornecedor\Dashboard as FornecedorDashboard;

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

Route::get('/', Login::class);

Route::get('/home', Dashboard::class)->name('home');
//usuarios
Route::get('/usuario/dashboard',  UsuarioDashboard::class)->name('view.user.dashboard');
Route::get('/usuario/create',  UserCreate::class)->name('view.user.create');
Route::get('/usuario/edit/{id}',  UserUpdate::class)->name('view.user.update');
//clientes
Route::get('/cliente/dashboard',  ClienteDashboard::class)->name('view.cliente.dashboard');
Route::get('/cliente/create',  ClienteCreate::class)->name('view.cliente.create');
Route::get('/cliente/edit/{id}',  ClienteUpdate::class)->name('view.cliente.update');
//fornecedores
Route::get('/fornecedor/dashboard',  FornecedorDashboard::class)->name('view.fornecedor.dashboard');
//serviços
Route::get('/servicos/dashboard', ServicoDashboard::class)->name('view.servico.dashboard');
Route::get('/servicos/vincular-taxa/{servico_id}', TaxasVincular::class)->name('view.servico.vincular-taxas');
//taxa
Route::get('/taxa/dashboard', TaxaDashboard::class)->name('view.taxa.dashboard');
//os
Route::get('/os/create', OSCreate::class)->name('view.os.create');
Route::get('/os/lista', OSLista::class)->name('view.os.lista');
Route::get('/os/pdf/{id}', [PDFC::class, 'os'])->name('os.pdf');
//despezas
Route::get('/despeza/create', DespezaCreate::class)->name('view.despeza.create');
