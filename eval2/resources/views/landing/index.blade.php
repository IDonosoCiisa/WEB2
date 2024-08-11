<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
<header class="bg-blue-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-2xl">Proyecto Dashboard</h1>
    <nav>
        <a href="{{ route('formLogin') }}" class="text-white mr-4">Login</a>
        <a href="{{ route('newUser') }}" class="text-white">Registrar</a>
    </nav>
</header>
<main class="p-4">
    <section class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-bold">Resumen de proyectos y usuarios</h2>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <article class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-bold">Usuarios</h2>
                <p class="text-sm">Total de usuarios: {{ $totalUsers }}</p>
            </article>
            <article class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-bold">Proyectos</h2>
                <p class="text-sm">Total de proyectos: {{ $totalProjects }}</p>
            </article>
            <article class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-bold">Proyectos recientes</h2>
                <p class="text-sm">{{ $recentProjects }}</p>
            </article>
        </section>
    </section>
</main>
<footer class="bg-gray-800 text-white text-center p-4 mt-8">
    <p>&copy; 2024 Project Dashboard</p>
</footer>
</body>
</html>
