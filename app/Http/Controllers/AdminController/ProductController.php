<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::get();

        return view('admin.product.create')->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'category_id' => ['required', 'string'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable','mimes:jpg,png,jpeg,JPEG','max:2048']
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images/post-images', 'public');
        }

        Product::create([
            'vendor_id' =>$vendor->id,
            'category_id' => $request->category_id,
            'img_path' =>$imagePath ? $imagePath : null,
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Haryt ustunlikli gosuldy!');
    }
    
    public function destroy($porductId)
    {
        $product = Product::where('id', $porductId)->first();

        $product -> delete();
        
        return back()->with([
            'success' => 'Haryt ustunlikli pozuldy!'
        ]);
    }
}
