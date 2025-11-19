<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
            'phone' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'max:30'],
        ]);

        if (Auth::guard('admin')->attempt($validated)) {

            $request->session()->regenerate();

            return redirect()->route('admin.index')->with([
                'success' => 'Ustunlikli giris edildi'
            ]);
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with([
                'success' => 'Ustunlikli cykys edildi',
            ]);
    }
}
