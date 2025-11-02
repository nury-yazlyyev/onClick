<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SigninController extends Controller
{
    public function create(){
        return view('client.auth.signin');
    }

    public function store(Request $request){
        $request->validate([
            'email' => ['required','email','max:30',Rule::unique(User::class)],
            'phone' => ['required','string', Rule::unique(User::class)],
            'username' => ['required','string','min:3','max:25', Rule::unique(User::class)],
            'password' => ['required','min:6','max:25','confirmed'],
            'password_confirmation' => ['required']
        ]);

        $user = User::create([
            'username' =>$request->username,
            'password' =>$request->password,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'is_seller' =>false
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home')->with([
            'success' =>'Ustunlikli giris edildi'
        ]);


        
    }
}
