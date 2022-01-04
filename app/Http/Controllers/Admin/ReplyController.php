<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //method buat tambah reply di komen user
    public function addReply(Request $request, Comment $comment)
    {
        //save reply ke database dengan id dari comment yang dipilih dan description
        Reply::query()->create([
           'comment_id' => $comment->id,
           'description' => $request->description
        ]);

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Reply added!');
    }

    //method buat admin update reply
    public function updateReply(Request $request, Reply $reply)
    {
        //update description dari reply yang dipilih
        $reply->update([
            'description' => $request->description
        ]);

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Reply updated!');
    }

    //method buat admin hapus reply dari komen user
    public function deleteReply(Reply $reply)
    {
        //hapus reply yang dipilih dari database
        $reply->delete();

        //redirect ke halaman yang sama dengan pesan peringatan
        return redirect()->back()->with('danger', 'Reply deleted!');
    }
}
