<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function addReply(Request $request, Comment $comment)
    {
        Reply::query()->create([
           'comment_id' => $comment->id,
           'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'Reply added!');
    }

    public function updateReply(Request $request, Reply $reply)
    {
        $reply->update([
            'description' => $request->description
        ]);
        return redirect()->back()->with('success', 'Reply updated!');
    }

    public function deleteReply(Reply $reply)
    {
        $reply->delete();
        return redirect()->back()->with('danger', 'Reply deleted!');
    }
}
