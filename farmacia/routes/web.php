<?php

use Illuminate\Support\Facades\Route;

Route::get('/','LoginController@index');
Route::post('/activar','LoginController@store_key');
Route::post('/ingreso','LoginController@start');
Route::get('/menu','LoginController@get_user');
Route::get('/salir','LoginController@exit');
Route::get('/caja','LoginController@ini_caja');
Route::post('/caja/agregar','LoginController@store');

Route::get('producto','ProductoController@index');
Route::get('producto/agregar','ProductoController@ini_create');
Route::post('producto/agregar','ProductoController@store');
Route::get('producto/editar/{id}','ProductoController@ini_edit');
Route::post('producto/editar/{id}','ProductoController@update');
Route::get('producto/eliminar/{id}','ProductoController@destroy');
Route::get('producto/imprimir','ProductoController@print');
Route::get('pdf',array('as'=>'pdf','uses'=>'BestInterviewQuestionController@producto'));//PDF

Route::get('usuario','UsuarioController@index');
Route::get('usuario/agregar','UsuarioController@ini_create');
Route::post('usuario/agregar','UsuarioController@store');
Route::get('usuario/editar/{id}','UsuarioController@ini_edit');
Route::post('usuario/editar/{id}','UsuarioController@update');
Route::get('usuario/eliminar/{id}','UsuarioController@destroy');

Route::get('reporte','ReporteController@index');
Route::post('reporte/buscar','ReporteController@search');
Route::get('reporte/caja/{id}','ReporteController@ini_caja');
Route::post('reporte/caja/editar/{id}','ReporteController@upd_caja');

Route::get('recibo','ReciboController@index');
Route::post('recibo/editar','ReciboController@update');

Route::get('ventas','VentaController@index');
Route::get('ventas/searchC','VentaController@searchC'); //ajax
Route::get('ventas/searchN','VentaController@searchN'); //ajax
Route::post('ventas/agregar','VentaController@store');
Route::get('ventas/imprimir/{id}','VentaController@print');
Route::get('qr-code-g', function () {
    \QrCode::size(500)
              ->format('png')
              ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
              return redirect()->action('VentaController@print');
});