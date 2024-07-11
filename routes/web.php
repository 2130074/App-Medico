<?php

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProductosDoctorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\PacientesDoctorController;
use App\Http\Controllers\VerServiciosController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiciosDoctorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaDocController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

// POST para los formularios 
Route::get('logout',[LoginController::class,'logout'])->name('logout');
Route::post('/validar-registro',[LoginController::class, 'register'])->name('validar-registro');
Route::post('/verificar-login', [LoginController::class, 'doLogin'])->name('verificar-login');
Route::post('/registrar', [PacienteController::class, 'registerPatient'])->name('registrar');
Route::post('/registrar-pacientes', [PacientesController::class, 'registerPatient'])->name('registrar-pacientes');
Route::post('/registrar-pacientes-doc', [PacientesDoctorController::class, 'registerPatient'])->name('registrar-pacientes-doc');

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

Route::get('/docServicios', [ServiciosDoctorController::class, 'index'])->name('docServicios');
Route::delete('/docServicios/{servicio}', [ServiciosDoctorController::class, 'destroy'])->name('docServicios.destroy');
Route::get('/docServicios/editar/{servicio}', [ServiciosDoctorController::class, 'edit'])->name('docServicios.edit');
Route::put('/docServicios/update/{servicio}', [ServiciosDoctorController::class, 'update'])->name('docServicios.update');

Route::get('/docProductos', [ProductosDoctorController::class, 'index'])->name('docProductos');
Route::delete('/docProductos/{producto}', [ProductosDoctorController::class, 'destroy'])->name('docProductos.destroy');
Route::get('/docProductos/editar/{producto}', [ProductosDoctorController::class, 'edit'])->name('docProductos.edit');
Route::put('/docProductos/update/{producto}', [ProductosDoctorController::class, 'update'])->name('docProductos.update');

Route::get('/Productos', [ProductosController::class, 'index'])->name('Productos');
Route::delete('/Productos/{producto}', [ProductosController::class, 'destroy'])->name('Productos.destroy');
Route::get('/Productos/editar/{producto}', [ProductosController::class, 'edit'])->name('Productos.edit');
Route::put('/Productos/update/{producto}', [ProductosController::class, 'update'])->name('Productos.update');

Route::get('/docPacientes', [PacientesDoctorController::class, 'index'])->name('docPacientes');
Route::get('/detallesPacientes/{id}', [PacientesDoctorController::class, 'show'])->name('pacientes.show');
Route::get('/expediente/{id}', [PacientesDoctorController::class, 'expediente']);
Route::get('/detallesCita/{id}', [PacientesDoctorController::class, 'detallesCita']);
Route::get('/cita/{id}', [PacientesDoctorController::class, 'detallesCita'])->name('detallesCita');
Route::post('/actualizarCita/{id}', [PacientesDoctorController::class, 'actualizarCita'])->name('actualizarCita');
Route::delete('/docPacientes/{paciente}', [PacientesDoctorController::class, 'destroy'])->name('docPacientes.destroy');
Route::get('/docPacientes/{paciente}/modificar', [PacientesDoctorController::class, 'edit'])->name('pacientesDoc.edit');
Route::put('/docPacientes/{paciente}/actualizar', [PacientesDoctorController::class, 'update'])->name('pacientesDoc.update');

// Ver pagos de un paciente específico
Route::get('/pago/{id}', [PacientesController::class, 'verPagos'])->name('verPagos');
Route::get('/pago/{paciente_id}', [CitaController::class, 'verPago'])->name('verPago');
Route::post('/pago/cambiarEstado/{cita_id}', [CitaController::class, 'cambiarEstadoPago'])->name('cambiarEstadoPago');

Route::get('/vender', [VentaController::class, 'create'])->name('vender.create');
Route::post('/vender', [VentaController::class, 'store'])->name('vender.store');
Route::get('/venta/max-stock/{id}', [VentaController::class, 'obtenerMaxStock'])->name('venta.obtenerMaxStock');

Route::get('/ventas', [VentaDocController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaDocController::class, 'store'])->name('ventas.store');
Route::get('/ventas/max-stock/{id}', [VentaController::class, 'obtenerMaxStock'])->name('ventas.obtenerMaxStock');

Route::resource('recepcionista', CitaController::class)->middleware(['auth','verified']);
Route::resource('doctor', DoctorController::class)->middleware(['auth','verified']);
Route::resource('servicios', ServicioController::class)->middleware(['auth','verified']);
Route::resource('crearServicio', ServiciosDoctorController::class)->middleware(['auth','verified']);
Route::resource('crearProducto', ProductosDoctorController::class)->middleware(['auth','verified']);
Route::resource('registrarProducto', ProductosController::class)->middleware(['auth','verified']);

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

Route::get('/registroPacientesDoc', function () {
    return view('doc.registroPacientesDoc');
})->name('registroPacientesDoc');

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

Route::get('/docIngresos', function () {
    return view('doc.docIngresos');
})->name('docIngresos');

Route::get('/modificarPacientesDoc', function () {
    return view('doc.modificarPacientesDoc');
})->name('modificarPacientesDoc');

Route::get('/crearServicio', function () {
    return view('doc.crearServicio');
})->name('crearServicio');

Route::get('/crearProducto', function () {
    return view('doc.crearProducto');
})->name('crearProducto');

Route::get('/registrarProducto', function () {
    return view('recepcionista.registrarProducto');
})->name('registrarProducto');

Route::get('/Producto', function () {
    return view('recepcionista.Producto');
})->name('Producto');


Route::get('/registro', function () {
    return view('paciente.registro');
})->name('registro');

Route::get('/calendario', function () {
    return view('paciente.calendario');
})->name('calendario');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});