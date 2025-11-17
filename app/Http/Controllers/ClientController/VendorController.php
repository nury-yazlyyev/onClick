<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user) {

            return view('vendor.auth.signin');

        } else {

            return to_route('signin');
        };
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
        
        if (Auth::attempt($is_correct))
        {
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
            
            
            return redirect()->route('vendor.dashboard')->with([
                'success' => 'Ustunlikli Satyjy boldunyz!',
            ]);

        } else {
            return back()->with([
                'error' => 'Ullanyjy adynyz ya-da parolanyz yalnys!'
            ]);
        }

    }

    public function vendor_profile($id)
    {
        $vendor = Vendor::withCount(['products'])->where('id', $id)->firstOrFail();
        $products = $vendor->products;

        return view('client.home.vendor_profile')->with([
            'vendor' => $vendor,
            'products' => $products
        ]);
    }

    public function dashboard()
    {
        $categories = Category::get();
        $user = User::withCount(['followers', 'followings'])->where('id', Auth::user()->id)->first();
        $vendor = Vendor::withCount(['products'])->where('user_id', $user->id)->first();

        return view('vendor.dashboard.dashboard')->with([
            'categories' => $categories,
            'user' => $user,
            'vendor' =>$vendor,
            'products' =>$vendor->products
        ]);
    }
 }
