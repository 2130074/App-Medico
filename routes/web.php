<?php

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitasController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

// POST para los formularios 
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::post('/verificar-login', [LoginController::class, 'doLogin'])->name('verificar-login');
Route::post('/registrar-pacientes', [PacienteController::class, 'registerPatient'])->name('registrar-pacientes');
Route::post('/registrar-cita',[CitasController::class, 'registrarCita'])->name('registrar-cita');

// Vistas para navegación entre ventanas 
Route::get('/recepcionista', function () {
    return view('recepcionista');
})->name('recepcionista');

Route::get('/doctor', function () {
    return view('doctor');
})->name('doctor');

Route::get('/citas', function () {
    return view('citas');
});

Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/pago', function () {
    return view('pago');
});

Route::get('/detallesCita', function () {
    return view('detallesCita');
});

Route::get('/detallesPacientes', function () {
    return view('detallesPacientes');
});

Route::get('/expediente', function () {
    return view('expediente');
});

Route::get('/registroPacientes', function () {
    return view('registroPacientes');
});

Route::get('/registroUsuarios', function () {
    return view('registroUsuarios');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__.'/auth.php';

