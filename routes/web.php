<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/note',[NoteController::class, 'index'])->name('note.index');
Route::get('/note/create',[NoteController::class,'create'])->name('note.create');
Route::get('/note/{note}',[NoteController::class, 'show'])->name('note.show');
Route::get('/note/edit/{note}',[NoteController::class, 'edit'])->name('note.edit');
Route::post('/note/store',[NoteController::class,'store'])->name('note.store');
Route::put('/note/update/{note}',[NoteController::class,'update'])->name('note.update');
Route::delete('/note/delete/{note}',[NoteController::class,'delete'])->name('note.delete');
// post - put -delete esperan un csrf y un form tipo post con su metodo correspondiente

// otra forma de escribir rutas
// resoure lo que hace es crear todas las rutas que se necesitan para un CRUD o.o
// entonces no tenemos que nombrarlo ni especificarle una funcion
Route::resource('/post',NoteController::class);


//PODEMOS LISTAR LAS RUTAS USANDO
//php artisan route:list
//y observaremos como se crean todas las rutas para el  CRUD
//pero eso si, las rutas que te crea no son siempre las que se quieren
