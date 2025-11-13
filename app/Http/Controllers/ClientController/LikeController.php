<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($product_id)
    {
        $liked = false;
        $user = Auth::user();
        $like = Like::where('user_id', $user->id)->where('product_id', $product_id)->first();

        if ($like) {

            $like->delete();

        } else {
            Like::create([
                'product_id' => $product_id,
                'user_id' => $user->id,
            ]);  
            $liked = true;
        }
        return redirect()->back()->with([
            'liked' => $liked
        ]);
    }

    public function liked()
    {
        $user = Auth::user();

        return view('client.liked.index')->with([
            'liked' => $user->likes
        ]);
    }
}
