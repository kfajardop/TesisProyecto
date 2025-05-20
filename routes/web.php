<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PassportClientsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PruebaApiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('login/{driver}', [LoginController::class,'redirectToProvider'])->name('social_auth');
Route::get('login/{driver}/callback', [LoginController::class,'handleProviderCallback']);



/**
 * Rutas admin
 */
Route::group(['prefix' => 'admin','middleware' => ['role:Admin|Superadmin|Developer','auth']], function () {


    Route::group(['as' => 'admin.'],function (){

        Route::get('/', [HomeAdminController::class,'index'])->name('index');
        Route::get('/home', [HomeAdminController::class,'index'])->name('home');
        Route::get('/dashboard', [HomeAdminController::class,'dashboard'])->name('dashboard');
        Route::get('/calendar', [HomeAdminController::class,'calendar'])->name('calendar');

    });

    Route::group(['prefix' => 'dev','as' => 'dev.'],function (){

        Route::get('prueba/api',[PruebaApiController::class,'index'])->name('prueba.api');

        Route::get('passport/clients', [PassportClientsController::class,'index'])->name('passport.clients');

        Route::resource('configurations', ConfigurationController::class);

    });



    Route::get('profile/business', [BusinessProfileController::class,'index'])->name('profile.business');
    Route::post('profile/business', [BusinessProfileController::class,'store'])->name('profile.business.store');

    Route::get('profile', [ProfileController::class,'index'])->name('profile');
    Route::patch('profile/{user}', [ProfileController::class,'update'])->name('profile.update');
    Route::post('profile/{user}/edit/avatar', [ProfileController::class,'editAvatar'])->name('profile.edit.avatar');

    Route::resource('users', UserController::class);
    Route::get('user/{user}/menu', [UserController::class,'menu'])->name('user.menu');;
    Route::patch('user/menu/{user}', [UserController::class,'menuStore'])->name('users.menuStore');

    Route::get('option/create/{option}', [OptionController::class,'create'])->name('option.create');
    Route::get('option/orden', [OptionController::class,'updateOrden'])->name('option.order.store');
    Route::resource('options',OptionController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('permissions', PermissionController::class);



});





/**
 * Rutas web
 */
Route::group(['prefix' => ''], function () {


    Route::get('/', [HomeAdminController::class,'index'])->name('index');
    Route::get('home', [HomeAdminController::class,'index'])->name('home');
//    Route::get('/', [HomeController::class,'index'])->name('index');
//    Route::get('home', [HomeController::class,'index'])->name('home');

    Route::get('about', [HomeController::class,'about'])->name('about');
    Route::get('contact', [HomeController::class,'contact'])->name('contact');
    Route::get('cambio/idioma/{lang}', [HomeController::class,'cambioIdioma'])
        ->where([
            'lang' => 'en|es'
        ])
        ->name('cambio.idioma');


});

Route::post('casos/cambiar/etapa', [App\Http\Controllers\CasoController::class, 'cambiarEtapaCaso'])->name('casos.cambiar.etapa');
Route::resource('contactos', App\Http\Controllers\contactosController::class);
Route::resource('contactos', App\Http\Controllers\ContactoController::class);
Route::resource('tareaEstados', App\Http\Controllers\TareaEstadoController::class);
Route::resource('tareaPrioridads', App\Http\Controllers\TareaPrioridadController::class);
Route::resource('casoPenalEtapas', App\Http\Controllers\CasoPenalEtapaController::class);
Route::resource('casoPenalDelitos', App\Http\Controllers\CasoPenalDelitoController::class);
Route::resource('casoTipos', App\Http\Controllers\CasoTipoController::class);
Route::resource('personas', App\Http\Controllers\PersonaController::class);
Route::resource('casoFamiliarJuicioEtapas', App\Http\Controllers\CasoFamiliarJuicioEtapaController::class);
Route::resource('casoEstados', App\Http\Controllers\CasoEstadoController::class);
Route::resource('doctoPublicoEscrituras', App\Http\Controllers\DoctoPublicoEscrituraController::class);
Route::resource('documentoEstados', App\Http\Controllers\DocumentoEstadoController::class);
Route::resource('doctoPrivadoContratos', App\Http\Controllers\DoctoPrivadoContratoController::class);
Route::resource('doctoActaNotarials', App\Http\Controllers\DoctoActaNotarialController::class);
Route::resource('tareas', App\Http\Controllers\TareaController::class);
Route::resource('documentoTipos', App\Http\Controllers\DocumentoTipoController::class);
Route::resource('parteTipos', App\Http\Controllers\ParteTipoController::class);
Route::resource('casoFamiliarJuicioTipos', App\Http\Controllers\CasoFamiliarJuicioTipoController::class);
Route::resource('casos', App\Http\Controllers\CasoController::class);
Route::resource('casoFamiliarJuicioDetalles', App\Http\Controllers\CasoFamiliarJuicioDetalleController::class);
Route::resource('parteInvolucradaCasos', App\Http\Controllers\ParteInvolucradaCasosController::class);
Route::resource('casoPenalDetalles', App\Http\Controllers\CasoPenalDetalleController::class);
Route::resource('clientes', App\Http\Controllers\ClienteController::class);
Route::resource('departamentos', App\Http\Controllers\DepartamentoController::class);
Route::resource('municipios', App\Http\Controllers\MunicipioController::class);
Route::resource('direccions', App\Http\Controllers\DireccionController::class);
