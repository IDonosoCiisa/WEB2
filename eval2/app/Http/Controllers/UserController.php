<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class userController extends Controller
{
    public function formLogin()
    {
        if (Auth::check()){
            return redirect()->route('backoffice.dashboard');
        }
        return view('user.login');
    }

    public function validateLogin(Request $request)
    {
        $mensajes = [
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email no es válido',
            'password.required' => 'La contraseña es obligatoria'
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], $mensajes);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->activo) {
                Auth::Logout();
                return redirect()->back()->withErrors([
                    'email' => 'Usuario inactivo'
                ]);
            }
            $request->session()->regenerate();
            return redirect()->route('backoffice.dashboard');
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('raiz');
    }

    public function newUser()
    {
        if(Auth::check()){
            return redirect()->route('backoffice.dashboard');
        }
        return view('user.register');
    }
    public function register(Request $request)
    {
        $mensajes = [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email no es válido',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'dayCode.required' => 'El código de día es obligatorio'
        ];
        $request->validate([
            'nombre' => 'required|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'dayCode' => 'required'
        ], $mensajes);
        $data = $request->only('nombre', 'email', 'password', 'checkPassword', 'dayCode');
        if ($data['password'] != $data['checkPassword']) {
            return redirect()->back()->withErrors([
                'password' => 'Las contraseñas no coinciden'
            ]);

        }
        if ((int)$data['dayCode'] != (int)Carbon::now()->day) {
            return redirect()->back()->withErrors([
                'dayCode' => 'El código de día no es correcto'
            ]);
        }
        try {
            //activo 1 dada la naturaleza de la evaluación
            $password = Hash::make($data['password']);
            User::create([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'password' => $password,
                'activo' => 1
            ]);
            return redirect()->route('formLogin')->with('success', 'Usuario registrado correctamente');
        } catch (\Exception $ex) {
            if ($ex->getCode() == 23000) {
                return back()->withErrors([
                    'email' => 'El email ya está en uso'
                ]);
            }
            return redirect()->back()->with('error', 'Error al registrar el usuario');
        }
    }

}
