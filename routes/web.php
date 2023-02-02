<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactoController;

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
    $articles= Article::with('user')->orderBy('id', 'desc')->where('stock', '>', 0)->paginate(6);
    return view('welcome', compact('articles'));
})->name('inicio'); //nombraré esta ruta como 'inicio' y le pasaré todos los posts con stock>0, ordenados por id desc. y paginados de 6 en 6

//he decidido crear un método show el cual usaré para las vistas dashboard y welcome (sin estar autenticado en ambas, ya que será el mismo)
//no usaré por tanto el show que viene por defecto (ya que necesitaría estar autenticado y al no servirme tendría que implementar 2 show diferentes)
Route::get('/articles/showNoAuth/{article}', [ArticleController::class, 'showNoAuth'])->name('articles.showNoAuth'); //le indico a mi ruta que tendrá un parámetro y nombro la ruta como el métood

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', [ArticleController::class, 'index'])->name('dashboard'); //la ruta dashboard me la gestionará el método index de ArticleController

    Route::resource('articles', ArticleController::class);

    //rutas para procesar el formulario
    Route::get('/contacto', [ContactoController::class, 'pintarFormulario'])->name('contacto.pintar');
    Route::post('/contacto', [ContactoController::class, 'procesarFormulario'])->name('contacto.procesar');

});
