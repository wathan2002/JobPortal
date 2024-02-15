<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request, $id)
    {
        Comment::create([
            "news_id" => $id,
            "user_id" => Auth::user()->id,
            "comment" => $request->comment,
        ]);
        return back();
    }
}
