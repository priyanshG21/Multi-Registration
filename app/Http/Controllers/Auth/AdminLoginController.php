<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $admin = User::where('email', $validated['email'])->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        if ($admin->role !== 'admin') {
            return back()->withErrors(['email' => 'You are not allowed to login from here.']);
        }

        if (!$admin->is_verified) {
            return back()->withErrors(['email' => 'Please verify your account first']);
        }

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }
}
