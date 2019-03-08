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
    return view('web');
});

/**
 * WEB ---- - --- --- --- --- --- --- -- - -- - - - -- - - - 
 */
Route::get('/app/index', function () {
    return view('app.index');
});
Route::get('/app/informacion', function () {
    return view('app.informacion');
});
Route::get('/app/cambiartuclave', function () {
    return view('app.cambiartuclave');
});
Route::get('/app/exitosapayu', function () {
    return view('app.exitosapayu');
});
Route::get('/app/disputapayu', function () {
    return view('app.disputapayu');
});
Route::get('/app/confirmacionpayu', function () {
    return view('app.confirmacionpayu');
});
Route::get('/Mail/index', function () {
    return view('mail.index');
});
Route::get('/app/noexitopayu', function () {
    return view('app.noexitopayu');
});
Route::get('/app/pendientepayu', function () {
    return view('app.pendientepayu');
});
Route::get('/app/regresopayu', function () {
    return view('app.regresopayu');
});
/**
 * INFO WEB ---- -- -- - -- - - - -- - - - - - -- - 
 */
Route::get('/app/docente1', function () {
    return view('app.docente1');
});
Route::get('/app/estudiante1', function () {
    return view('app.estudiante1');
});
Route::get('/app/login', function () {
    return view('app.login');
});
Route::get('/app/olvido', function () {
    return view('app.olvido');
});
Route::get('/app/registroDocente', function () {
    return view('app.registroDocente');
});
Route::get('/app/registroEstudiante', function () {
    return view('app.registroEstudiante');
});
/**
 * WEB ESTUDIANTE
 */
Route::get('/estudiante/calificar', function () {
    return view('estudiante.calificar');
});
Route::get('/estudiante/cerrar', function () {
    return view('estudiante.cerrar');
});
Route::get('/estudiante/chat', function () {
    return view('estudiante.chat');
});
Route::get('/estudiante/chatsop', function () {
    return view('estudiante.chatsop');
});
Route::get('/estudiante/imagenesTareas', function () {
    return view('estudiante.imagenesTareas');
});
Route::get('/estudiante/imagenesWeb', function () {
    return view('estudiante.imagenesWeb');
});
Route::get('/estudiante/imagenesWebEdit', function () {
    return view('estudiante.imagenesWebEdit');
});
Route::get('/estudiante/index', function () {
    return view('estudiante.index');
});
Route::get('/estudiante/miperfilestudiante', function () {
    return view('estudiante.miperfilestudiante');
});
Route::get('/estudiante/mistokens', function () {
    return view('estudiante.mistokens');
});
Route::get('/estudiante/mostrarTarea', function () {
    return view('estudiante.mostrarTarea');
});
Route::get('/estudiante/notificaciones', function () {
    return view('estudiante.notificaciones');
});
Route::get('/estudiante/obsrMisTareas', function () {
    return view('estudiante.obsrMisTareas');
});
Route::get('/estudiante/payu', function () {
    return view('estudiante.payu');
});
Route::get('/estudiante/soporte', function () {
    return view('estudiante.soporte');
});
Route::get('/estudiante/subirtareas', function () {
    return view('estudiante.subirtareas');
});
Route::get('/estudiante/subirtareas1', function () {
    return view('estudiante.subirtareas1');
});
Route::get('/estudiante/tutorial', function () {
    return view('estudiante.tutorial');
});
/**
 * WEB DOCENTE -- --- ---- --- --- --- --- --- --- -- -- -- - -- - - -
 */
Route::get('/docente/allTarea', function () {
    return view('docente.allTarea');
});
Route::get('/docente/cerrar', function () {
    return view('docente.cerrar');
});
Route::get('/docente/chat', function () {
    return view('docente.chat');
});
Route::get('/docente/chatsop', function () {
    return view('docente.chatsop');
});
Route::get('/docente/imagenesSolucion', function () {
    return view('docente.imagenesSolucion');
});
Route::get('/docente/imagenesWeb', function () {
    return view('docente.imagenesWeb');
});
Route::get('/docente/imagenesWebEdit', function () {
    return view('docente.imagenesWebEdit');
});
Route::get('/docente/index', function () {
    return view('docente.index');
});
Route::get('/docente/miperfil', function () {
    return view('docente.miperfil');
});
Route::get('/docente/MostrarTarea', function () {
    return view('docente.MostrarTarea');
});
Route::get('/docente/notificaciones', function () {
    return view('docente.notificaciones');
});
Route::get('/docente/obsrMisTareas', function () {
    return view('docente.obsrMisTareas');
});
Route::get('/docente/soporte', function () {
    return view('docente.soporte');
});
Route::get('/docente/subirTareas', function () {
    return view('docente.subirTareas');
});
Route::get('/docente/tutorial', function () {
    return view('docente.tutorial');
});

/**
 * SERVICIO ----- --- --- -- -- -- -- -- -- -- -- -- -- - - - - - -- - 
 */
Route::post('/actualizarestudiante','EstudiantesController@actualizarestudiante');
Route::post('/asignar','EstudiantesController@asignar');
Route::post('/calificacion','Controller@calificacion');
Route::post('/chat','Controller@chat');
Route::post('/chathistorial','Controller@chathistorial');
Route::post('/comentario','Controller@comentario');
Route::post('/eliminar','EstudiantesController@eliminar');
Route::post('/login','Controller@login');
Route::post('/olvido','Controller@olvido');
Route::post('/registrodocente','DocentesController@registrodocente');
Route::post('/registroestudiante','EstudiantesController@registroestudiante');
Route::post('/registrosolucion','DocentesController@registrosolucion');
Route::post('/registrosolucion2','DocentesController@registrosolucion2');
Route::post('/registrotarea','EstudiantesController@registrotarea');
Route::post('/registrotarea2','EstudiantesController@registrotarea2');
Route::post('/reperar','Controller@reperar');
Route::post('/solicitud','EstudiantesController@solicitud');
Route::post('/solicitud1','EstudiantesController@solicitud1');
Route::post('/subir','Controller@subir');
Route::post('/subirarchivos','Controller@subirarchivos');
Route::post('/updatedocente','DocentesController@updatedocente');
Route::post('/updateestudiante','EstudiantesController@updateestudiante');
Route::post('/upload','Controller@upload');
/**
 * CONSULTAS -- -- - -- - - - - - -- - 
 */
Route::post('/consultas/idestudiante','ConsultasController@idestudiante');
Route::post('/consultas/iddocente','ConsultasController@iddocente');
Route::post('/consultas/consultarTokens','ConsultasController@consultarTokens');
Route::post('/consultas/consultarTareas','ConsultasController@consultarTareas');
Route::post('/consultas/consultarTareaIdImagen','ConsultasController@consultarTareaIdImagen');
Route::post('/consultas/consultarTareaIdestudiante','ConsultasController@consultarTareaIdestudiante');
Route::post('/consultas/consultarTareaId','ConsultasController@consultarTareaId');
Route::post('/consultas/consultarSolucionImagen','ConsultasController@consultarSolucionImagen');
Route::post('/consultas/consultarsolicitud','ConsultasController@consultarsolicitud');
Route::post('/consultas/consultarNotificacion','ConsultasController@consultarNotificacion');
Route::post('/consultas/consultaareaespecialista','ConsultasController@consultaareaespecialista');
Route::post('/consultas/consultaAdicional','ConsultasController@consultaAdicional');
/**
 * NOTIFICACIONES ---- -- --- --- -- --- --- ---
 */
Route::post('/notificaciones/onlyMessage','NotificacionesController@onlyMessage');
Route::post('/notificaciones/sendWebMessage','NotificacionesController@sendMessage');
Route::post('/notificaciones/viewMessage','NotificacionesController@viewMessage');

