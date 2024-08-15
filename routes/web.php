<?php

// Controllers
use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\DoctorColaboradorController;
use App\Http\Controllers\EnfermeraController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFController;

Route::post('/registroDoctor', [DoctorColaboradorController::class, 'registroDoctor'])->name('validar-registro-doctor');
Route::post('/registroEnfermera', [EnfermeraController::class, 'registroEnfermera'])->name('validar-registro-enfermera');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/verificar-login', [LoginController::class, 'doLogin'])->name('verificar-login');

Route::post('/registrar', [PacienteController::class, 'registerPatient'])->name('registrar');
Route::post('/registrar-pacientes', [PacientesController::class, 'registerPatient'])->name('registrar-pacientes');
Route::post('/registrar-pacientes-doc', [PacientesDoctorController::class, 'registerPatient'])->name('registrar-pacientes-doc');

//Para que funcione la tabla de ver usuarios 
Route::get('/verUsuarios', [UserController::class, 'index'])->name('verUsuarios');
Route::delete('/eliminar/{id}', [UserController::class, 'destroy'])->name('usuarios.eliminar');
Route::get('/modificar/{id}', [UserController::class, 'edit'])->name('usuarios.edit');
Route::post('/modificar/{id}', [UserController::class, 'update'])->name('usuarios.update');

//Para que funcione la tabla de ver doctor colaborador
Route::get('/DoctorColaborador', [DoctorColaboradorController::class, 'index'])->name('DoctorColaborador.index');
Route::delete('/DoctorColaborador/eliminar/{id}', [DoctorColaboradorController::class, 'destroy'])->name('doctores.eliminar');
Route::get('/modificarDoctor/{id}', [DoctorColaboradorController::class, 'edit'])->name('doctores.edit');
Route::put('/modificarDoctor/{id}', [DoctorColaboradorController::class, 'update'])->name('doctores.update');

//Para que funcione la tabla de ver enfermeras 
Route::get('/Enfermera', [EnfermeraController::class, 'index'])->name('Enfermera.index');
Route::get('/modificarEnfermera/{id}', [EnfermeraController::class, 'edit'])->name('enfermera.edit');
Route::put('/modificarEnfermera/{id}', [EnfermeraController::class, 'update'])->name('enfermera.update');
Route::delete('/Enfermera/{id}', [EnfermeraController::class, 'destroy'])->name('enfermera.eliminar');

//Para que funcione la tabla de ver pacientes del lado de la recepcionista 
Route::get('/verPacientes', [PacientesController::class, 'index'])->name('verPacientes');
Route::get('/verPacientes/{paciente}/modificar', [PacientesController::class, 'edit'])->name('pacientes.edit');
Route::put('/verPacientes/{paciente}/actualizar', [PacientesController::class, 'update'])->name('pacientes.update');

Route::get('/verServicios', [VerServiciosController::class, 'index'])->name('verServicios');
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
Route::get('/docIngresos', [CitaController::class, 'ingresosDiarios'])->name('ingresos.diarios');

Route::get('/vender', [VentaController::class, 'create'])->name('vender.create');
Route::post('/vender', [VentaController::class, 'store'])->name('vender.store');
Route::get('/venta/max-stock/{id}', [VentaController::class, 'obtenerMaxStock'])->name('venta.obtenerMaxStock');

Route::get('/ventas', [VentaDocController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaDocController::class, 'store'])->name('ventas.store');
Route::get('/ventas/max-stock/{id}', [VentaController::class, 'obtenerMaxStock'])->name('ventas.obtenerMaxStock');

Route::resource('recepcionista', CitaController::class)->middleware(['auth', 'verified']);
Route::resource('doctor', DoctorController::class)->middleware(['auth', 'verified']);
Route::get('/perfil', [PacienteController::class, 'showProfile'])->name('paciente.perfil')->middleware(['auth:paciente', 'verified']);
Route::resource('servicios', ServicioController::class)->middleware(['auth', 'verified']);
Route::resource('crearServicio', ServiciosDoctorController::class)->middleware(['auth', 'verified']);
Route::resource('crearProducto', ProductosDoctorController::class)->middleware(['auth', 'verified']);
Route::resource('registrarProducto', ProductosController::class)->middleware(['auth', 'verified']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/doctor/cita/{id}', [PacientesDoctorController::class, 'detallesCita'])->name('detallesCita');

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

Route::get('/registroUsuarios', function () {
    return view('registroUsuarios');
});

Route::get('/registroPacientes', function () {
    return view('registroPacientes');
});

Route::get('/registroPacientesDoc', function () {
    return view('doc.registroPacientesDoc');
})->name('registroPacientesDoc');

Route::get('/notificaciones', function () {
    return view('doc.notificaciones');
})->name('notificaciones');

Route::get('/registroDoctor', function () {
    return view('admin.registroDoctor');
})->name('registroDoctor');

Route::get('/registroEnfermera', function () {
    return view('admin.registroEnfermera');
})->name('registroEnfermera');

Route::get('/inicioDocColab', function () {
    return view('docColab.inicioDocColab');
})->name('inicioDocColab');

Route::get('/modificar', function () {
    return view('modificar');
});

Route::get('/modificarPacientes', function () {
    return view('modificarPacientes');
});

Route::get('/modificarEnfermera', function () {
    return view('admin.modificarEnfermera');
})->name('modificarEnfermera');

Route::get('/modificarDoctor', function () {
    return view('admin.modificarDoctor');
})->name('modificarDoctor');

Route::get('/modificarServicio', function () {
    return view('modificarServicio');
});

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

Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generate.pdf');

//doctor colaborador 
Route::post('/enviar-opinion', [DoctorColaboradorController::class, 'enviarOpinion'])->name('enviar.opinion');
Route::get('/inicioDocColab', [DoctorColaboradorController::class, 'mostrarInicioDocColab'])->name('inicioDocColab');

Route::post('inicioDocColab//{id}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::get('/notificaciones', [ReplyController::class, 'showNotificationsWithReplies'])->name('doc.notificaciones');

//Route::get('generate-pdf', [PDFController::class, 'generatePDF']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
