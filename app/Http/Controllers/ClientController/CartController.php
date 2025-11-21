<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('client.cart.index');
    }

    public function addToCart(Request $request)
    {
        $variation = ProductVariation::where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->where('color_id', $request->color_id)
            ->first();
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        if (!$variation) {
            return redirect()->back()->with([
                'error' => 'Haryt Gutardy'
            ]);
        }

        if (!$cart) {
            $newCart = Cart::create([
                'user_id' => Auth::user()->id,
            ]);
        }

        CartItem::create([
            'cart_id' => $cart->id ?? $newCart->id,
            'product_variation_id' => $variation->id,
            'quantity' => 1
        ]);

        $variation->stock -= 1;
        $variation->save();

        return redirect()->back()->with('success', 'Succesfully added to Cart');
    }


}
