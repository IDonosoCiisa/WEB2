<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    @vite('resources/js/projectActions.js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">
<div class="flex justify-between items-center p-4 bg-white shadow-md">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <h1>{{ $user->nombre }}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Logout</button>
    </form>
</div>
<div class="p-8">
    <h2 class="text-xl font-semibold mb-4">Proyectos</h2>
    <button onclick="openModal('createModal')" class="bg-blue-600 text-white px-4 py-2 rounded-md mb-4 inline-block">Crear Proyecto</button>
    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Nombre del proyecto</th>
            <th class="py-2 px-4 border-b">Responsable</th>
            <th class="py-2 px-4 border-b">Fecha Inicio</th>
            <th class="py-2 px-4 border-b">Estado</th>
            <th class="py-2 px-4 border-b">Precio</th>
            <th class="py-2 px-4 border-b">Acciones</th>
        </tr>
        </thead>
        <tbody id="projectTable">
        @foreach ($proyectos as $proyecto)
            <tr id="project-{{ $proyecto->id }}">
                <td class="py-2 px-4 border-b">{{ $proyecto->nombre }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->responsable }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->fecha_inicio }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->estado ? 'Active' : 'Inactive' }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->monto }}</td>
                <td class="py-2 px-4 border-b">
                    <button data-id="{{ $proyecto->id }}" class="bg-blue-600 text-white px-2 py-1 rounded-md view-btn">Ver</button>
                    <button data-id="{{ $proyecto->id }}" class="bg-yellow-500 text-white px-2 py-1 rounded-md edit-btn">Editar</button>
                    <button data-id="{{ $proyecto->id }}" class="bg-red-600 text-white px-2 py-1 rounded-md delete-btn">Borrar</button>
                    @if($proyecto->estado)
                        <button data-id="{{ $proyecto->id }}" class="bg-gray-600 text-white px-2 py-1 rounded-md activate-btn">Desactivar</button>
                    @else
                        <button data-id="{{ $proyecto->id }}" class="bg-green-600 text-white px-2 py-1 rounded-md deactivate-btn">Activar</button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md">
        <h2 class="text-xl font-semibold mb-4">Crear proyecto</h2>
        <form id="createProjectForm">
            @csrf
            <input type="hidden" name="created_by" id="created_by" value="{{ $user->id }}">
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del proyecto</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="responsable" class="block text-sm font-medium text-gray-700">Responsable</label>
                <input type="text" name="responsable" id="responsable" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="monto" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" name="monto" id="monto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('createModal')" class="bg-gray-600 text-white px-4 py-2 rounded-md mr-2">Cancelar</button>
                <button type="button" onclick="createProject()" class="bg-blue-600 text-white px-4 py-2 rounded-md">Crear</button>
            </div>
        </form>
    </div>
</div>

<div id="updateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md">
        <h2 class="text-xl font-semibold mb-4">Actualizar Proyecto</h2>
        <form id="updateProjectForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="project_id" id="update_project_id">
            <div class="mb-4">
                <label for="update_nombre" class="block text-sm font-medium text-gray-700">Nombre del proyecto</label>
                <input type="text" name="nombre" id="update_nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="update_responsable" class="block text-sm font-medium text-gray-700">Responsable</label>
                <input type="text" name="responsable" id="update_responsable" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="update_fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                <input type="date" name="fecha_inicio" id="update_fecha_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="update_monto" class="block text-sm font-medium text-gray-700">Cantidad</label>
                <input type="number" name="monto" id="update_monto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('updateModal')" class="bg-gray-600 text-white px-4 py-2 rounded-md mr-2">Cancelar</button>
                <button type="button" onclick="updateProject()" class="bg-blue-600 text-white px-4 py-2 rounded-md">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<div id="viewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md">
        <h2 class="text-xl font-semibold mb-4">Detalles del Proyecto</h2>
        <div id="projectDetails">
            <p><strong>Nombre del proyecto:</strong> <span id="view_nombre"></span></p>
            <p><strong>Responsable:</strong> <span id="view_responsable"></span></p>
            <p><strong>Fecha de inicio:</strong> <span id="view_fecha_inicio"></span></p>
            <p><strong>Estado:</strong> <span id="view_estado"></span></p>
            <p><strong>Cantidad:</strong> <span id="view_monto"></span></p>
            <p><strong>Ultima Actualización:</strong> <span id="updated_at"></span></p>
        </div>
        <div class="flex justify-end mt-4">
            <button type="button" onclick="closeModal('viewModal')" class="bg-gray-600 text-white px-4 py-2 rounded-md">Cerrar</button>
        </div>
    </div>
</div>
</body>
</html>
