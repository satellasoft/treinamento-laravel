<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'username' => 'As credenciais estão incorretas.',
            ]);
        }

        $request->session()->regenerate();
        
        return redirect()->route('dashboard');
    }
}
