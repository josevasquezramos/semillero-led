<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Define las reglas de validación
        $rules = [
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',  // Puedes ajustar las reglas según tus necesidades
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ];

        // Crea el validador
        $validator = Validator::make($request->all(), $rules);

        // Verifica si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();  // Mantiene los datos del formulario en caso de error
        }

        // Si la validación pasa, actualiza el usuario
        $user = auth()->user();
        $user->update($request->only('name', 'phone', 'email'));

        // Guarda el valor del tab activo en la sesión
        session()->flash('activeTab', 'profile');

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }


    public function updatePassword(Request $request)
    {
        // Definir las reglas de validación
        $rules = [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];

        // Realizar la validación manual
        $validator = Validator::make($request->all(), $rules);

        // Verificar si la validación falló
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput() // Mantener los datos del formulario
                ->with('activeTab', 'password'); // Mantener la pestaña activa
        }

        $user = Auth::user();

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'La contraseña actual no es correcta.'])
                ->withInput() // Mantener los datos del formulario
                ->with('activeTab', 'password'); // Mantener la pestaña activa
        }

        // Actualizar la contraseña
        $user->update(['password' => Hash::make($request->password)]);

        // Redirigir con mensaje de éxito
        return redirect()->back()
            ->with('success', 'Contraseña actualizada correctamente.')
            ->with('activeTab', 'password'); // Mantener la pestaña activa
    }
}
