<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Inicio Doctor Colaborador</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .main-container {
            display: flex;
            height: 100%;
        }

        .sidebar {
            width: 20%;
            background: #4CA9DF;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .content {
            margin-left: 20%;
            padding: 20px;
            width: 80%;
            height: 100%;
            overflow-y: auto;
            background: linear-gradient(to right, #4CA9DF, #292E91);
        }

        .notification-card {
            margin-bottom: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .notification-card:hover {
            transform: translateY(-5px);
        }

        /* Estilo para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-[#4CA9DF] to-[#292E91]">
    <div class="main-container">
        <!-- Sidebar -->
        <div class="sidebar bg-blue-650 text-white w-1/5 p-6 flex flex-col justify-between shadow-xl">
            <div class="flex items-center mb-8">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 mr-2">
                <span class="text-2xl font-bold">Salud Conecta</span>
            </div>
            <button
                class="w-full py-2 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                onclick="location.href='/'">
                Cerrar sesión
            </button>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Mensaje de bienvenida -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-white text-center mb-2">¡Bienvenido, {{ $doctor->nombre_completo }}!</h1>
                <h2 class="text-2xl font-bold text-white">Notificaciones</h2>
            </div>

            <!-- Notificaciones -->
            <div class="space-y-6">
                @if ($notificaciones->isEmpty())
                    <p class="text-gray-500 text-lg">No hay notificaciones disponibles.</p>
                @else
                    @foreach ($notificaciones as $notificacion)
                        <div class="notification-card">
                            <p class="text-lg">{{ $notificacion->message }}</p>
                            <p class="text-sm text-gray-500 mt-2">{{ $notificacion->created_at->format('d/m/Y H:i') }}</p>
                            @if ($notificacion->pdf_path)
                                <a href="{{ $notificacion->pdf_path }}" target="_blank" class="text-blue-500 hover:underline mt-2 block">Ver PDF</a>
                            @endif
                            <!-- Enlace para abrir el modal de respuesta -->
                            <a href="#" class="text-blue-500 hover:underline mt-2 block" onclick="openModal('{{ $notificacion->id }}')">Responder</a>
                        </div>

                        <!-- Modal de respuesta -->
                        <div id="modal-{{ $notificacion->id }}" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('{{ $notificacion->id }}')">&times;</span>
                                <h2>{{ $notificacion->message }}</h2>
                                <p>Enviado el: {{ $notificacion->created_at->format('d/m/Y H:i') }}</p>

                                @if($notificacion->pdf_path)
                                    <a href="{{ $notificacion->pdf_path }}" target="_blank">Ver PDF</a>
                                @endif

                                <!-- Formulario para responder -->
                                <form action="{{ route('replies.store', $notificacion->id) }}" method="POST">
                                    @csrf
                                    <textarea name="message" rows="4" class="w-full mt-4 p-2 border rounded" placeholder="Escribe tu respuesta aquí..."></textarea>
                                    <button type="submit" class="mt-2 bg-blue-500 text-white py-2 px-4 rounded">Enviar Respuesta</button>
                                </form>

                                <!-- Mostrar respuestas anteriores -->
                                <div class="mt-6">
                                    <h3>Respuestas:</h3>
                                    @foreach($notificacion->replies as $reply)
                                        <div class="bg-gray-100 p-4 mt-2 rounded">
                                            <p>{{ $reply->message }}</p>
                                            <p class="text-sm text-gray-500">Enviado a las {{ $reply->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }
    </script>
</body>

</html>
