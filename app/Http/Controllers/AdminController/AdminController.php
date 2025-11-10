<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        $categories = Category::get();
        $vendors = Vendor::get();
        $products = Product::paginate(20);
        $i=1;

        return view('admin.index')->with([
            'categories' =>$categories,
            'vendors' =>$vendors,
            'products' =>$products,
            'i' =>$i
        ]);
    }

    public function create()
    {
        $vendors = Vendor::get();
        $categories = Category::get();

        return view('admin.create')->with([
            'vendors' => $vendors,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'string'],
            'description' => ['nullable', 'max:255'],
            'image' => ['nullable','mimes:jpg,png,jpeg,JPEG','max:2048']
        ]);

            // $imagePath=null;
        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images/post-images', 'public');
        }

        Product::create([
            'vendor_id' =>$vendor->id,
            'category_id' => $request->category_id,
            'img_path' =>$imagePath ? $imagePath : null,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Haryt ustunlikli gosuldy!');
    }
}
