<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountSettingsController extends Controller
{
    // Muestra el formulario para editar la información del perfil del usuario autenticado
    public function edit()
    {
        $user = Auth::user();
       
        return view('settings.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validar la información del formulario
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Actualizar el usuario
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        // Redirigir con un mensaje de éxito
        return view('settings.update');

    }
    // Actualiza la información del perfil del usuario autenticado
}
