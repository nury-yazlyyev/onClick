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
        $vendor = Vendor::withCount(['followers','followings', 'products'])->where('id', $id)->firstOrFail();
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
        $vendor = Vendor::where('user_id', $user->id)->first();

        return view('vendor.dashboard.dashboard')->with([
            'categories' => $categories,
            'user' => $user,
            'vendor' =>$vendor
        ]);
    }

    public function vendor_store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'string'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable', 'mimes:jpg,png,jpeg,JPEG', 'max:2048']
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/post-images', 'public');
        }

        Product::create([
            'vendor_id' => $user->vendor->id,
            'category_id' => $request->category_id,
            'img_path' => $imagePath ? $imagePath : null,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return redirect()->back()->with([
            'success' => 'Haryt ustunlikli gosuldy!',
        ]);
    }
}
