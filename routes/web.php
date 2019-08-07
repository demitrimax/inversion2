<?php

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
    return view('welcome');
});

Auth::routes();



Route::group(['middleware'=>['auth', 'activity']], function() {
  Route::get('/home', 'HomeController@index')->name('home');
  //RUTAS DE LA CONFIGURACION
  Route::resource('roles','RoleController');
  Route::resource('user','UserController');
  Route::resource('permissions', 'PermissionController');

  Route::resource('creditos', 'creditosController');
  Route::get('getCuentasempresa/{idempresa}', 'creditosController@getCuentasempresa');

  Route::resource('efinancieras', 'efinancieraController');
  Route::resource('cproyectos', 'cproyectosController');

  Route::post('movimiento/guardar', 'creditosController@regmov')->name('movimiento.store');
  Route::get('CorridaFinanciera/{id}', 'creditosController@crearCorridaFinanciera')->name('CorridaFinanciera.create');
  Route::get('getCreditoPagos/{id}', 'creditosController@getCreditoPagos');

  Route::resource('clasificas', 'clasificaController');

  Route::resource('bancos', 'bancosController');

  Route::resource('empresas', 'empresasController');
  Route::post('empresas/pagocredito', 'empresasController@pagocredito')->name('credito.pay');
  Route::post('empresa/proyecto/inversion', 'empresasController@inverproy')->name('inversion.proyecto');
  Route::get('empresa/{id}/mes/{mesanio}/subcategoria/{subcategoriaid}', 'empresasController@detalleoperaciones')->name('detalle.categoria');

  Route::post('operaciones/guardar', 'empresasController@regoper')->name('operacion.store');
  Route::post('operaciones/{id}/eliminar','empresasController@elimoper')->name('operacion.destroy');
  Route::post('inversion/{id}/eliminar','empresasController@eliminver')->name('movcredito.destroy');

  Route::resource('bcuentas', 'bcuentasController');
  Route::resource('metpagos', 'metpagoController');
  Route::resource('proveedores', 'proveedoresController');
  Route::resource('coddivisas', 'coddivisasController');
  Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

  Route::resource('operaciones', 'operacionesController');

  Route::resource('subclasificas', 'subclasificaController');
  Route::get('/profile', 'profileController@profile')->name('profile');

  Route::resource('facturas', 'facturasController');

  Route::resource('tareas', 'tareasController');
  Route::post('tareas/avance', 'tareasController@registroavance')->name('tareas.avanceregistro');

  Route::get('tareas/todas/all', 'tareasController@todasindex')->name('tareas.todas');

  Route::resource('categorias', 'categoriasController');
});
