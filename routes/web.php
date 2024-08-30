<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Showcursos;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', 'show')->name('show');
    Route::post('/update', 'updateProfile')->name('update');
    Route::post('/update-password', 'updatePassword')->name('update-password');
});

/*
Route::get('/test', function () {
    return view('test.index', ['cursos'=>Curso::paginate(2)]);
});
Route::get('/test/{grupo}', function (Grupo $grupo) {
    return $grupo;
})->name('test');
*/

/*
Route::get('/test', function () {

    // Mail::send('emails.asistencia', ['mensaje' => 'mi mensaje pe'], function($message) {
    //     $message->to('test@gmail.com');
    //     $message->subject('Este es el encabezado');
    // });
    // return "PRUEBA ENVIADA";

    // $grupos = Grupo::with('registros')->get();
    // return $grupos;

    // return view('test');
})->name('test');
*/