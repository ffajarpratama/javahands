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
        //cari comment berdasarkan id, kalo gada return 404
        $comment = Comment::query()->findOrFail($comment_id);
        //cari data di table dislikes dimana comment_id sama dengan comment_id di url dan user id sama dengan id user yang login
        $disliked = Dislike::query()
            ->where('comment_id', $comment->id)
            ->where('user_id', auth()->id())
            ->first();
        //kalo dislikenya udah ada
        if ($disliked) {
            //hapus dislike
            $disliked->delete();
        } else {
            //kalo belum ada, tambahin dislike ke database
            Dislike::query()->create([
                'comment_id' => $comment->id,
                'user_id' => auth()->id()
            ]);
        }

        //return jumlah dislike sebagai json, karena request dilakukan oleh axios
        //script axios like sama dislike bisa diliat di view user/like/script
        return response()->json($comment->dislikes->count());
    }
}
