<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function create()
    {
        return view('vendor.auth.signin');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:12'],
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'shop_name' => ['required', 'string', 'min:3', 'max:25'],
        ]);

        $is_correct = $request->only(['phone', 'username', 'password']);

        if (Auth::attempt($is_correct)) {
            $user = Auth::user();

            $request->session()->regenerate();

            /** @var \App\Models\User $user */
            $user->is_seller = true;
            $user->save();


            Vendor::create([
                'user_id' => $user->id,
                'name' => $request->shop_name
            ]);

            $request->session()->regenerate();


            return redirect()->back()->with([
                'success' => 'Satyjy ustunlikli doredildi!',
            ]);
        } else {
            return back()->with([
                'error' => 'Ullanyjy ady ya-da parola yalnys!'
            ]);
        }
    }
}
