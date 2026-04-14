<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ──────────────────────────────────────
    //  LOGIN
    // ──────────────────────────────────────

    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt (admin only path).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Admins go to the admin panel; clients go to catalog
            return Auth::user()->isAdmin()
                ? redirect()->intended('/admin/productos')
                : redirect()->intended('/catalogo');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // ──────────────────────────────────────
    //  REGISTER (clientes)
    // ──────────────────────────────────────

    /**
     * Show the customer registration form.
     */
    public function showRegisterForm()
    {
        // Already logged-in users don't need to register
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    /**
     * Handle a new customer registration.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:100'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'password'              => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'cliente',
        ]);

        Auth::login($user);

        return redirect('/catalogo')->with('success', '¡Bienvenido a Tienda FCA, ' . $user->name . '!');
    }
}
