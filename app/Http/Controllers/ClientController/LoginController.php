<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create(){
        return view('client.auth.login');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'username' =>['required', 'string'],
            'password' =>['required']
        ]);

        if (Auth::attempt($validated)){

            $request->session()->regenerate();

            return redirect()->back()->with([
                'success' =>'Ustunlikli giris edildi'
            ]);
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with([
                'success' => 'Ustunlikli cykys edildi',
            ]);
    }
}
