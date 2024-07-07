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
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DoctorController;
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
Route::get('/modificar/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
Route::post('/modificar/{id}', [UserController::class, 'update'])->name('usuarios.update');


Route::get('/verPacientes', [PacientesController::class, 'index'])->name('verPacientes');
Route::delete('/verPacientes/{paciente}', [PacientesController::class, 'destroy'])->name('verPacientes.destroy');
Route::get('/verPacientes/{paciente}/modificar', [PacientesController::class, 'edit'])->name('pacientes.edit');
Route::put('/verPacientes/{paciente}/actualizar', [PacientesController::class, 'update'])->name('pacientes.update');

Route::get('/verServicios', [VerServiciosController::class, 'index'])->name('verServicios');
Route::delete('/verServicios/{servicio}', [VerServiciosController::class, 'destroy'])->name('verServicios.destroy');
Route::get('/verServicios/editar/{servicio}', [VerServiciosController::class, 'edit'])->name('verServicios.edit');
Route::put('/verServicios/update/{servicio}', [VerServiciosController::class, 'update'])->name('verServicios.update');

Route::get('/docPacientes', [PacientesDoctorController::class, 'index'])->name('docPacientes');
Route::get('/detallesPacientes/{id}', [PacientesDoctorController::class, 'show'])->name('pacientes.show');
Route::get('/expediente/{id}', [PacientesDoctorController::class, 'expediente']);
Route::get('/detallesCita/{id}', [PacientesDoctorController::class, 'detallesCita']);
Route::post('/actualizarCita/{id}', [PacientesDoctorController::class, 'actualizarCita'])->name('actualizarCita');

// Ver pagos de un paciente específico
Route::get('/pago/{id}', [PacientesController::class, 'verPagos'])->name('verPagos');
Route::get('/pago/{paciente_id}', [CitaController::class, 'verPago'])->name('verPago');
Route::post('/pago/cambiarEstado/{cita_id}', [CitaController::class, 'cambiarEstadoPago'])->name('cambiarEstadoPago');

Route::resource('recepcionista', CitaController::class)->middleware(['auth','verified']);
Route::resource('doctor', DoctorController::class)->middleware(['auth','verified']);
Route::resource('servicios', ServicioController::class)->middleware(['auth','verified']);

// Vistas para navegación entre ventanas 
Route::get('/citas', function () {
    return view('citas');
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

Route::get('/docServicios', function () {
    return view('doc.docServicios');
})->name('docServicios');

Route::get('/docProductos', function () {
    return view('doc.docProductos');
})->name('docProductos');

Route::get('/docIngresos', function () {
    return view('doc.docIngresos');
})->name('docIngresos');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});