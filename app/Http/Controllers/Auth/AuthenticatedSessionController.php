<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate(); // gunakan LoginRequest untuk proses auth default (web guard)

        $request->session()->regenerate();

        $user = Auth::user();

        // Arahkan berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'kyai') {
            return redirect()->route('kyai.dashboard');
        } else {
            Auth::logout(); // logout jika bukan admin atau kyai
            return redirect()->route('login')->withErrors(['Akses hanya untuk admin atau kyai.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout(); // logout default guard

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
