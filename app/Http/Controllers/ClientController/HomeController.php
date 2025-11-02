<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request)
    {

        $request->validate([
            'VendorId' => ['nullable', 'integer', 'min:1'],
            'CategoryId' => ['nullable', 'integer', 'min:1'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $f_vendor = $request->VendorId ? $request->VendorId : 0;
        $f_category = $request->CategoryId ? $request->CategoryId : 0;
        $f_search = $request->search ?? null;

        $products = Product::when(isset($f_search), function ($query) use ($f_search) {
            return $query->where(function ($query) use ($f_search) {
                $query->where('name', 'like', '%' . $f_search . '%')
                    ->orWhere('description', 'like', '%' . $f_search . '%');
            })
                ->orWhereHas('vendor', function ($query) use ($f_search) {
                    return $query->where('name', 'like', '%' . $f_search. '%');
                })
                ->orWhereHas('category', function ($query) use ($f_search) {
                    return $query->where('name', 'like', '%' . $f_search. '%');
                });
        })
            ->when($f_vendor, function ($query) use ($f_vendor) {
                return $query->where('vendor_id', $f_vendor);
            })->when($f_category, function ($query) use ($f_category) {
                return $query->where('category_id', $f_category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30)
            ->withQueryString();

        $vendors = Vendor::get();
        $categories = Category::get();
        $is_auth = Auth::user();

        return view('client.home.index')->with([
            'products' => $products,
            'vendors' => $vendors,
            'categories' => $categories,
            'f_search' =>$f_search,
            'is_auth' =>$is_auth
        ]);
    }

    public function show($id)
    {

        $product = Product::where('id', $id)->firstOrFail();
        $vendor = $product->vendor_id;
        $user = Vendor::where('id', $vendor)->first();
        $user2 = User::withCount(['followers', 'followings'])->where('id', $user->user_id)->first();

        return view('client.home.show')->with([
            'product' => $product,
            'vendor' =>$vendor,
            'user' => $user2
        ]);
    }

    public function shops(){
        $vendors = Vendor::withCount(['followers', 'followings'])->get();
        $user_me = Auth::user();

        return view('client.home.vendors')->with([
            'vendors' => $vendors,
            'user_me' => $user_me,
        ]);
    }

    public function locale($locale)
    {
        $locale = in_array($locale, ['tm', 'ru']) ? $locale : 'en';
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
