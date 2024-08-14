<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { color: #003152; }
        .container { margin: 20px; }
        .section { margin-bottom: 20px; }
        .section label { font-weight: bold; }
        .section ul { list-style-type: disc; margin-left: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $titulo }}</h1>
        <h2>{{ $subtitulo }}</h2>

        <div class="section">
            <label>Paciente:</label> {{ $paciente->nombre }} {{ $paciente->apellidos }}
        </div>

        <div class="section">
            <label>Servicio:</label> {{ $servicio }}
        </div>

        <div class="section">
            <label>Precio del servicio:</label> {{ $precio_servicio }}
        </div>

        <div class="section">
            <label>Motivo de la cita:</label> {{ $motivo }}
        </div>

        <div class="section">
            <label>Fecha:</label> {{ $fecha }}
        </div>

        <div class="section">
            <label>Hora:</label> {{ $hora }}
        </div>

        <div class="section">
            <label>Edad:</label> {{ $edad }}
        </div>

        <div class="section">
            <label>Género:</label> {{ $genero }}
        </div>

        <div class="section">
            <label>Altura (cm):</label> {{ $altura }}
        </div>

        <div class="section">
            <label>Peso (kg):</label> {{ $peso }}
        </div>

        <div class="section">
            <label>Enfermedades:</label> {{ $enfermedades }}
        </div>

        <div class="section">
            <label>Alergias:</label> {{ $alergias }}
        </div>

        <div class="section">
            <label>Temperatura:</label> {{ $temperatura }}
        </div>

        <div class="section">
            <label>Presión arterial:</label> {{ $presion_arterial }}
        </div>

        <div class="section">
            <label>Diagnóstico:</label> {{ $diagnostico }}
        </div>
        
        <div class="section">
            <label>Enfermera:</label> {{ $enfermera }} - Sueldo: {{ $sueldo_enfermera }}
        </div>

        <div class="section">
            <label>Estudios a realizar:</label>
            <ul>
                @foreach ($estudios as $estudio)
                    <li>{{ $estudio }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <label>Medicamentos recetados:</label>
            <ul>
                @foreach ($medicamentos as $medicamento)
                    <li>
                        {{ $medicamento['medicamento'] }} - {{ $medicamento['dosis'] }} ({{ $medicamento['frecuencia'] }}, {{ $medicamento['duracion'] }})
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <label>Productos usados:</label>
            <ul>
                @foreach ($productos as $producto)
                    <li>{{ $producto['nombre'] }} - Cantidad: {{ $producto['cantidad'] }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <label>Precio del servicio:</label> {{ $precio_servicio }}
        </div>

        <div class="section">
            <label>Total:</label> {{ $total }}
        </div>
    </div>
</body>
</html>
