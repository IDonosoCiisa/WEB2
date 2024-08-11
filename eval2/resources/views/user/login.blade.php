<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6">Login</h2>
        <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        </div>
        <form method="POST" action="{{ route('validateLogin') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Login</button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">¿Aún no eres usuario? <a href="{{ route('newUser') }}" class="text-blue-600">Regístrate aquí</a></p>
        </div>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600"><a href="{{ route('raiz') }}" class="text-blue-600">Volver a inicio</a></p>
        </div>
    </div>
</div>
</body>
</html>
