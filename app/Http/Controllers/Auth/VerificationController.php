<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function showForm()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);
        $email = $request->session()->get('verifying_email');
        $role = $request->session()->get('verifying_role');

        if (!$email) {
            return redirect()->route('register.customer.form');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Account not found.']);
        }

        if ($user->verification_code !== $validated['code']) {
            return back()->withErrors(['code' => 'Invalid verification code.']);
        }

        $user->is_verified = true;
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        if ($user->role === 'admin') {
            Auth::login($user);
            $request->session()->regenerate();
            $request->session()->forget(['verifying_email', 'verifying_role']);
            return redirect()->route('admin.dashboard');
        }

        // Keep verification flow gated only via registration path
        $request->session()->forget(['verifying_email', 'verifying_role']);
        return redirect()->route('register.customer.form')->with('status', 'Your account has been verified.');
    }
}
