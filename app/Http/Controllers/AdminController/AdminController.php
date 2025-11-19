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

        return view('admin.home.index')->with([
            'categories' =>$categories,
            'vendors' =>$vendors,
            'products' =>$products,
            'i' =>$i
        ]);
    }
}
