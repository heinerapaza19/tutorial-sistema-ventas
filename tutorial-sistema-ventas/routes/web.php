<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecuperarClaveController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route("home");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* mis rutas de mi perffil*/
/*<div class="fl-flex-label col-12 col-lg-6">
<input type="number" class="input input__text m-4" placeholder="DNI" value="">
</div>*/
Route::get("mi-perfil", [PerfilController::class,"index"])->name("usuario.perfil")->middleware('verified');
Route::post("actualizar-foto-perfil", [PerfilController::class,"actualizarIMG"])->name("perfil.actualizarIMG")->middleware('verified');
Route::get("eliminar-fot-perfil", [PerfilController::class, "eliminarFotoPerfil"])->name("perfil.eliminarFotoPerfil")->middleware('verified');
Route::put("actualizar-datos-perfil", [PerfilController::class, "actualizarDatos"])->name("perfil.actulizarDatos")->middleware('verified');


//empresa
Route::get('empresa-index',[EmpresaController::class,'index'])->name('empresa.index')->middleware('verified');
Route::post('empresa-update-{id}',[EmpresaController::class,'update'])->name('empresa.update')->middleware('verified');
Route::post("actualizar-logo", [EmpresaController::class, "actualizarLogo"])->name("empresa.actualizarLogo")->middleware('verified');
Route::delete("eliminar-logo", [EmpresaController::class, "eliminarLogo"])->name("empresa.eliminarLogo")->middleware('verified');