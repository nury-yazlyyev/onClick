<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function following ($vendorId)
    {
        $userId = Auth::user()->id;

        $isFollowing = Follow::where('user_id', $userId)->where('vendor_id',$vendorId)->first();

        if ($userId == $vendorId){
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
                'user_id' => $userId,
                'vendor_id' => $vendorId,
            ]);
        }

        return redirect()->back()->with([
            'isFollowing' => $isFollowing
        ]);
    }
}
