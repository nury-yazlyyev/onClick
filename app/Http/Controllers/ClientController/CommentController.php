<?php

namespace App\Http\Controllers\ClientController;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'parentId' => ['nullable', 'integer'],
            'comment' => ['required', 'max:255'],
        ]);

        $f_parentId = $request->parentId ?? null;

        Comment::create([
            'product_id' => $id,
            'user_id' => Auth::id(),
            'parent_id' => $f_parentId,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with([
            'success' => ' Comment succesfully added!'
        ]);
    }
}
