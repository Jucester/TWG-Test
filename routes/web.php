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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Protected routes
Route::group(['middleware' => ['auth']], function() {

    // Ruta para mostrar todas las publicaciones
    Route::get('/publications', 'App\Http\Controllers\PublicationController@index')->name('publications.index');
    
    // Ruta para mostrar el formulario y almacenar la publicación en la DB 
    Route::get('/publications/create', 'App\Http\Controllers\PublicationController@create')->name('publications.create');
    Route::post('/publications', 'App\Http\Controllers\PublicationController@store')->name('publications.store');

    // Ruta para mostrar ver la publicación 
    Route::get('/publications/{publication}', 'App\Http\Controllers\PublicationController@show')->name('publications.show');



    // Rutas para comentarios
    Route::post('/publications/{publicationId}/comment', 'App\Http\Controllers\CommentController@store')->name('comment.store');

    
});

