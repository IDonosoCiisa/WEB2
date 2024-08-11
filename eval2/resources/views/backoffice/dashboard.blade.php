<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 text-gray-900">
<div class="flex justify-between items-center p-4 bg-white shadow-md">
    <h1 class="text-2xl font-semibold">Dashboard</h1>
    <h2>{{ $user->nombre }}</h2>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Logout</button>
    </form>
</div>
<div class="p-8">
    <h2 class="text-xl font-semibold mb-4">Projects</h2>
    <button onclick="openModal('createModal')" class="bg-blue-600 text-white px-4 py-2 rounded-md mb-4 inline-block">Create Project</button>
    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="py-2 px-4 border-b">Project Name</th>
            <th class="py-2 px-4 border-b">Responsible</th>
            <th class="py-2 px-4 border-b">Start Date</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">Amount</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($proyectos as $proyecto)
            <tr>
                <td class="py-2 px-4 border-b">{{ $proyecto->nombre }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->responsable }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->fecha_inicio }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->estado ? 'Active' : 'Inactive' }}</td>
                <td class="py-2 px-4 border-b">{{ $proyecto->monto }}</td>
                <td class="py-2 px-4 border-b">
                    <button onclick="openModal('editModal-{{ $proyecto->id }}')" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Edit</button>
                    <form action="" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded-md">Delete</button>
                    </form>
                    @if($proyecto->estado)
                        <form action="" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-gray-600 text-white px-2 py-1 rounded-md">Deactivate</button>
                        </form>
                    @else
                        <form action="" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded-md">Activate</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Create Project Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-md">
        <h2 class="text-xl font-semibold mb-4">Create Project</h2>
        <form action="" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Project Name</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="responsable" class="block text-sm font-medium text-gray-700">Responsible</label>
                <input type="text" name="responsable" id="responsable" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="estado" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="estado" id="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="monto" class="block text-sm font-medium text-gray-700">Amount</label>
                <input type="number" name="monto" id="monto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal('createModal')" class="bg-gray-600 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Project Modals -->
@foreach ($proyectos as $proyecto)
    <div id="editModal-{{ $proyecto->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-md">
            <h2 class="text-xl font-semibold mb-4">Edit Project</h2>
            <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nombre-{{ $proyecto->id }}" class="block text-sm font-medium text-gray-700">Project Name</label>
                    <input type="text" name="nombre" id="nombre-{{ $proyecto->id }}" value="{{ $proyecto->nombre }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="responsable-{{ $proyecto->id }}" class="block text-sm font-medium text-gray-700">Responsible</label>
                    <input type="text" name="responsable" id="responsable-{{ $proyecto->id }}" value="{{ $proyecto->responsable }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="fecha_inicio-{{ $proyecto->id }}" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio-{{ $proyecto->id }}" value="{{ $proyecto->fecha_inicio }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label for="estado-{{ $proyecto->id }}" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="estado" id="estado-{{ $proyecto->id }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="1" {{ $proyecto->estado ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$proyecto->estado ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="monto-{{ $proyecto->id }}" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="monto" id="monto-{{ $proyecto->id }}" value="{{ $proyecto->monto }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal('editModal-{{ $proyecto->id }}')" class="bg-gray-600 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
</body>
</html>
