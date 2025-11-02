<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function following ($vendorId)
    {
        $user = Auth::user()->id;
        $user2 = Vendor::where('id', $vendorId)->first();

        $isFollowing = Follow::where('following_id', $user)->where('follower_id',$user2->user_id)->first();

        if ($user == $user2->user_id){
            return back()->with([
                'error' => 'Oz-ozini pod edip bolonok'
            ]);
        }

        if ($isFollowing)
        {
            $isFollowing->delete();    
        } else 
        {
            Follow::create([
                'following_id' => $user,
                'follower_id' => $user2->user_id,
            ]);
        }

        return back()->with([
            'success' =>'User succesfully',
            
        ]);
    }
}
