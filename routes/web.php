<?php

use App\Http\Livewire\Pages\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Pages\Dashboard;
use App\Http\Livewire\Pages\Cliente\Create as UserCreate;
use App\Http\Livewire\Pages\Usuarios\Update as UserUpdate;
use App\Http\Livewire\Pages\Cliente\Dashboard as ClienteDashboard;
use App\Http\Livewire\Pages\Usuarios\Dashboard as  UsuarioDashboard;
use App\Http\Livewire\Components\Cliente\FormCreate as ClienteCreate;

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

Route::get('/usuario/dashboard',  UsuarioDashboard::class)->name('view.user.dashboard');
Route::get('/usuario/create',  UserCreate::class)->name('view.user.create');
Route::get('/usuario/edit/{id}',  UserUpdate::class)->name('view.user.update');

Route::get('/cliente/dashboard',  ClienteDashboard::class)->name('view.cliente.dashboard');
Route::get('/cliente/create',  UserCreate::class)->name('view.cliente.create');
