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
        //cari comment berdasarkan id, kalo gada return 404
        $comment = Comment::query()->findOrFail($comment_id);
        //cari data di table likes dimana comment_id sama dengan comment_id di url dan user id sama dengan id user yang login
        $liked = Like::query()
            ->where('comment_id', $comment->id)
            ->where('user_id', auth()->id())
            ->first();
        //kalo likenya udah ada
        if ($liked) {
            //hapus like
            $liked->delete();
        } else {
            //kalo belum ada, tambahin like ke database
            Like::query()->create([
                'comment_id' => $comment->id,
                'user_id' => auth()->id()
            ]);
        }

        //return jumlah like sebagai json, karena request dilakukan oleh axios
        //script axios like sama dislike bisa diliat di view user/like/script
        return response()->json($comment->likes->count());
    }
}
