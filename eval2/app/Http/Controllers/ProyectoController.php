<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class ProyectoController extends Controller
{
    public function getAll()
    {
        $proyectos = Proyecto::all();
        return response()->json($proyectos);
    }

    public function getOne($id)
    {
        try {
            $proyecto = Proyecto::findOrFail($id);
            return response()->json($proyecto);
        } catch (ModelNotFoundException $e) {
            return response()->json(null, 404);
        }
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
        try {
            $proyecto = Proyecto::create($request->all());
            return response()->json($proyecto, 201);
        } catch (\RuntimeException $e) {
            return response()->json(null, 500);
        }


    }

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

        try {
            $proyecto->updateOrFail($request->all());
            return response()->json($proyecto);
        } catch (ModelNotFoundException $e) {
            return response()->json(null, 404);
        }
    }

    public function activate(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }
        try {
            $proyecto->updateOrFail(['estado' => 1]);
            return response()->json($proyecto);
        } catch (ModelNotFoundException $e) {
            return response()->json(null, 404);
        }
    }

    public function deactivate(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            '_token' => 'required'
        ]);

        if ($request->_token !== csrf_token()) {
            return response()->json(['error' => 'Token Inválido'], 403);
        }

        try {
            $proyecto->updateOrFail(['estado' => 0]);
            return response()->json($proyecto);
        } catch (ModelNotFoundException $e) {
            return response()->json(null, 404);
        }
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

        try {
            $proyecto->deleteOrFail();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(null, 404);
        }
    }
}
