<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold mb-6">Register</h2>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{ route('validateRegister') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-6">
                <label for="checkPassword" class="block text-sm font-medium text-gray-700">Confirma tu Password</label>
                <input type="password" id="checkPassword" name="checkPassword" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-6">
                <label for="dayCode" class="block text-sm font-medium text-gray-700">Ingresa el còdigo del dìa</label>
                <input type="text" id="dayCode" name="dayCode" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Register</button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600"><a href="{{ route('raiz') }}" class="text-blue-600">Volver a inicio</a></p>
        </div>
    </div>
</div>
</body>
</html>
