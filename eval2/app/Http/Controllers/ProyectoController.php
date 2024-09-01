<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;


class ProyectoController extends Controller
{
    public function getAll()
    {
        $proyectos = Proyecto::all();
        return response()->json($proyectos);
    }

    public function getOne(Proyecto $proyecto)
    {
        return response()->json($proyecto);
    }

    // Create a new project
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'responsable' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'monto' => 'required|numeric',
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }

        $proyecto = Proyecto::create($request->all());
        return response()->json($proyecto, 201);
    }

    // Update an existing project
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'responsable' => 'sometimes|required|string|max:255',
            'fecha_inicio' => 'sometimes|required|date',
            'estado' => 'sometimes|required|boolean',
            'monto' => 'sometimes|required|numeric',
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }

        $proyecto->update($request->all());
        return response()->json($proyecto);
    }

    // Activate a project
    public function activate(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }

        $proyecto->update(['estado' => 1]);
        return response()->json($proyecto);
    }

    // Deactivate a project
    public function deactivate(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }

        $proyecto->update(['estado' => 0]);
        return response()->json($proyecto);
    }

    // Delete a project
    public function destroy(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }

        $proyecto->delete();
        return response()->json(null, 204);
    }
}
