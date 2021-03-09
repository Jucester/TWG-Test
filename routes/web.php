<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();

// Protected routes
Route::group(['middleware' => ['auth']], function() {

    // Ruta para mostrar todas las publicaciones
    Route::get('/publications', 'App\Http\Controllers\PublicationController@index')->name('publications.index');
    
    // Ruta para mostrar el formulario y almacenar la publicación en la DB 
    Route::get('/publications/create', 'App\Http\Controllers\PublicationController@create')->name('publications.create');
    Route::post('/publications', 'App\Http\Controllers\PublicationController@store')->name('publications.store');

    // Ruta para mostrar la publicación 
    Route::get('/publications/{publication}', 'App\Http\Controllers\PublicationController@show')->name('publications.show');

    // Ruta para obtener la vista de edición (get) y la ruta de actualizar en la DB (put) de la publicación
    Route::get('/publications/{publication}/edit', 'App\Http\Controllers\PublicationController@edit')->name('publications.edit');
    Route::put('/publications/{publication}', 'App\Http\Controllers\PublicationController@update')->name('publications.update');
    // Ruta para eliminar una publicación
    Route::delete('/publications/{publication}', 'App\Http\Controllers\PublicationController@destroy')->name('publications.destroy');

    // Ruta para mostrar todas las publicaciones de un usuario
    Route::get('/profile', 'App\Http\Controllers\PublicationController@profile')->name('publications.profile');

    // Rutas para comentarios
    Route::post('/publications/{publicationId}/comment', 'App\Http\Controllers\CommentController@store')->name('comment.store');

    // Ruta para aprobar comentarios
    Route::get('/publications/{publication}/comments', 'App\Http\Controllers\PublicationController@comments')->name('publications.comments');
    Route::get('/comments/{comment}/approve', 'App\Http\Controllers\CommentController@approve')->name('comment.approve');
    Route::delete('/comments/{comment}', 'App\Http\Controllers\CommentController@destroy')->name('comment.destroy');
    

});

