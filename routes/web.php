<?php

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\PacientesDoctorController;
use App\Http\Controllers\VerServiciosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

// POST para los formularios 
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::post('/verificar-login', [LoginController::class, 'doLogin'])->name('verificar-login');
Route::post('/registrar-pacientes', [PacienteController::class, 'registerPatient'])->name('registrar-pacientes');

//Para que funcionen las tablas
Route::get('/verUsuarios', [UserController::class, 'index'])->name('verUsuarios');
Route::delete('/eliminar/{id}', [UserController::class, 'destroy'])->name('usuarios.eliminar');
Route::get('/verPacientes', [PacientesController::class, 'index'])->name('verPacientes');
Route::get('/eliminar/{id}', [PacientesController::class, 'destroy'])->name('pacientes.eliminar');
Route::get('/docPacientes', [PacientesDoctorController::class, 'index'])->name('docPacientes');

Route::get('/verServicios', [VerServiciosController::class, 'index'])->name('verServicios');

Route::get('/detallesPacientes/{id}', [PacientesDoctorController::class, 'show'])->name('pacientes.show');

Route::get('/servicios', [ServicioController::class, 'create'])->name('servicios.create');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');


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
})->name('detallesPacientes');

Route::get('/expediente', function () {
    return view('expediente');
});

Route::get('/registroPacientes', function () {
    return view('registroPacientes');
});

Route::get('/registroUsuarios', function () {
    return view('registroUsuarios');
})->name('admin');

Route::get('/modificar', function () {
    return view('modificar');
});

Route::get('/modificarPacientes', function () {
    return view('modificarPacientes');
});

Route::get('/modificarServicio', function () {
    return view('modificarServicio');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});