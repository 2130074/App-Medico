<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;

class VerServiciosController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('verServicios', compact('servicios'));
    }
}