<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dislike;
use App\Models\Like;
use Illuminate\Http\Request;

class DislikeController extends Controller
{
    public function dislike($comment_id)
    {
        $comment = Comment::query()->findOrFail($comment_id);
        $liked = Dislike::query()
            ->where('comment_id', $comment->id)
            ->where('user_id', auth()->id())
            ->first();
        if ($liked) {
            $liked->delete();
        } else {
            Dislike::query()->create([
                'comment_id' => $comment->id,
                'user_id' => auth()->id()
            ]);
        }
        return response()->json($comment->dislikes->count());
    }
}
