<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function showLogin(){
        return view('loginRegister.login');
    }

    public function showRegister(){
        return view('loginRegister.register');
    }

    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Si la validación falla, redirigir de vuelta con los errores
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Si la validación es exitosa, crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Asegúrate de hashear la contraseña
        ]);

        // Redirigir a la página que deseas después del registro
        return redirect()->route('login'); // Asegúrate de tener una ruta nombrada 'home'
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate(); // Prevenir la fijación de sesión

            return redirect()->intended('dashboard'); // Redirigir al dashboard o a donde sea necesario
        }

        // Si la autenticación falla, lanzar una excepción de validación
        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
