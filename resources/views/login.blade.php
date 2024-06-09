<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>

<body style="background-image: url('img/fondo.jpg'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <div class="flex justify-center items-center h-full">
        <div class="bg-opacity-75 bg-white p-4 md:p-10 rounded-lg shadow-xl flex flex-col items-center w-full max-w-md">
            <h2 class=" text-4xl font-bold mt-6 text-blue-600 hover:text-blue-500">Bienvenido</h2>
            <form class="mt-6 w-full" action="{{ route('verificar-login') }}" method="POST">
                @csrf    
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="correo" id="correo"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        required>
                </div>
                <div class="flex-grow flex items-center justify-center mt-6">
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Iniciar sesión
                    </button>
                </div>
            </form>
            <p class="mt-6 text-center text-sm text-gray-600">
                No tienes cuenta? <a href="#" class="font-medium text-blue-600 hover:text-blue-500" onclick="location.href='/registroUsuarios'"> Regístrate
                </a>
            </p>
        </div>
    </div>
</body>

</html>
