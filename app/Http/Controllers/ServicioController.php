<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicioRequest;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('servicios', ['servicios' => Servicio::latest()->paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicioRequest $request)
    
    {
        try {
            Servicio::create($request->validated());
            return redirect()->route('verServicios')->with('success', 'Servicio registrado correctamente');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Hubo un problema al insertar datos. Por favor, intentalo de nuevo']);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Servicio $servicio)
    {
        return view('servicos.verServicios' , compact('medico'));
    }
}
