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
  //RUTA DE LA BUSQUEDA globals
  Route::post('/buscar', 'HomeController@busqueda')->name('busqueda.total');
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
  route::post('empresa/{id}/ordencategorias', 'empresasController@OrdenCategoriasJson');
  route::get('empresa/{empresaid}/ordensubcategoriasjson', 'empresasController@OrdenSubcategoriasJson');

  Route::post('operaciones/guardar', 'empresasController@regoper')->name('operacion.store');
  Route::post('operaciones/{id}/eliminar','empresasController@elimoper')->name('operacion.destroy');
  Route::post('inversion/{id}/eliminar','empresasController@eliminver')->name('movcredito.destroy');
  //ruta para guardar la operacion y el inventario
  Route::post('operaciones/empresa/{id}/inventario', 'operacionesController@operacionInventario')->name('operacion.empresa.inventario');

  Route::resource('bcuentas', 'bcuentasController');
  Route::resource('metpagos', 'metpagoController');
  Route::resource('proveedores', 'proveedoresController');
  Route::resource('coddivisas', 'coddivisasController');

  Route::get('otroslogs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

  Route::resource('operaciones', 'operacionesController');
  Route::post('operacion/comisionable/save', 'operacionesController@saveOperacionComisionable');
  Route::post('operacion/inventario/save', 'operacionesController@saveOperacionInventario')->name('operacion.inventario.save');

  Route::resource('subclasificas', 'subclasificaController');
  Route::get('/profile', 'profileController@profile')->name('profile');

  Route::resource('facturas', 'facturasController');
  Route::get('getdetalle/facturas/{id}', 'facturasController@getDetalleFactura');

  Route::resource('tareas', 'tareasController');
  Route::post('tareas/avance', 'tareasController@registroavance')->name('tareas.avanceregistro');
  Route::post('tareas/avance/comentario', 'tareasController@regcomentarioavance')->name('tareas.avance.comentario');
  Route::get('tareas/avance/{id}/comentarios', 'tareasController@verComentariosAvance');

  Route::get('tareas/todas/all', 'tareasController@todasindex')->name('tareas.todas');

  Route::resource('categorias', 'categoriasController');

  Route::resource('productos', 'productosController');

  Route::resource('bodegas', 'bodegasController');

  Route::resource('clientes', 'clientesController');

  Route::resource('invoperacions', 'invoperacionController');
  Route::get('inventario/entrada', 'invoperacionController@entrada')->name('inventario.entrada');
  Route::get('inventario/salida', 'invoperacionController@salida')->name('inventario.salida');
  Route::post('inventario/entrada/registro', 'invoperacionController@regentrada')->name('inventario.regentrada');
  Route::post('inventario/salida/registro', 'invoperacionController@regsalida')->name('inventario.regsalida');
  Route::get('precio/venta/producto/{id}', 'invoperacionController@precioventaproducto');
  Route::get('precio/compra/producto/{id}', 'invoperacionController@preciocompraproducto');
  Route::post('inventario/operacion/producto/{id}/surtidototal', 'invoperacionController@surtidototalproducto')->name('inventario.producto.surtido.total');
  Route::post('inventario/operacion/producto/{id}/surtidoparcial', 'invoperacionController@surtidoparcialproducto')->name('inventario.producto.surtido.parcial');
  Route::get('inventario/informe/productos', 'invoperacionController@verinformeproductos')->name('inventario.informe.productos');
  Route::get('inventario/salida/{id}/remision', 'invoperacionController@repsalidaremision')->name('invoperacions.miformato');
  Route::get('inventario/operacion/{id}/estafacturada', 'invoperacionController@OperacionFacturada')->name('invoperacions.esta.facturada');
  Route::post('inventario/operacion/{id}/actualizar', 'invoperacionController@updateRemision')->name('invoperacions.updateRemision');

  Route::get('inventario/informe/ver1', 'invoperacionController@informeVer1');
  Route::get('inventario/informe/ver2', 'invoperacionController@informeVer2');

  Route::resource('invproveedores', 'invproveedoresController');
  Route::resource('facturaras', 'facturaraController');

  Route::get('backup', 'BackupController@index');
  Route::get('backup/create', 'BackupController@create');
  Route::get('backup/download/{file_name}', 'BackupController@download');
  Route::get('backup/delete/{file_name}', 'BackupController@delete');
  Route::get('backup/createbackup', 'BackupController@createbackup');

  Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

  Route::resource('minventarios', 'minventarioController');
  Route::get('minventario/resguardo/{id}', 'minventarioController@viewPDF');
  Route::post('minventario/{id}/agregar', 'minventarioController@agregarproducto');

  Route::get('mailable', function () {
    $tarea = App\Models\tareas::find(18);

    return new App\Mail\TareasVencidas($tarea);

  });


});
//al llamar esta pagina enviará ejecutará la funcion de enviar mails diarios
Route::get('tareasvencidas', 'mailtareasController@tareasVencidas');
