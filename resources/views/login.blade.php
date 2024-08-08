<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>

<body class="h-screen bg-gradient-to-r from-[#4CA9DF] to-[#292E91] flex items-center justify-center">
    <div class="bg-white bg-opacity-10 p-8 rounded-lg shadow-xl w-full max-w-sm">
        <div class="flex flex-col items-center mb-6">
            <img src="img/profile.png" alt="Login Icon" class="w-20 h-20 mb-4">
            <h2 class="text-4xl font-bold mb-6 text-white">Login</h2>
        </div>

        <form class="w-full" action="{{ route('verificar-login') }}" method="POST">
            @csrf
            <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                <img src="img/email.png" alt="correo Icon" class="w-6 h-6 ml-2">
                <input type="email" name="correo" id="correo"
                    class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                    placeholder="Correo" required>
            </div>
            
            <div class="mb-4 flex items-center bg-white bg-opacity-20 rounded-md shadow-sm">
                <img src="img/candado.png" alt="Password Icon" class="w-6 h-6 ml-2">
                <input type="password" name="password" id="password"
                    class="flex-grow px-3 py-2 bg-transparent border-none rounded-md focus:outline-none focus:ring-0 text-white placeholder-white"
                    placeholder="Password" required>
            </div>
            
            <div class="flex-grow flex items-center justify-center mt-6">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Iniciar sesión
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-white text-xs">
            <span>Únete a nuestra comunidad y encuentra el mejor tratamiento médico para ti y tu familia. </span><a href="{{ route('registro') }}" class="font-bold underline">¡Regístrate ahora!</a>.
        </div>
    </div>
</body>

</html>