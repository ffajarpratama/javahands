<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($comment_id)
    {
        $comment = Comment::query()->findOrFail($comment_id);
        $liked = Like::query()
            ->where('comment_id', $comment->id)
            ->where('user_id', auth()->id())
            ->first();
        if ($liked) {
            $liked->delete();
        } else {
            Like::query()->create([
                'comment_id' => $comment->id,
                'user_id' => auth()->id()
            ]);
        }
        return response()->json($comment->likes->count());
    }
}
