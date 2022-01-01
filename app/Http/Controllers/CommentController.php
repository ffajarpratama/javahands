<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Salmanbe\FileName\FileName;

class CommentController extends Controller
{
    public function store(Request $request, Product $product, User $user)
    {
        $imageExt = $request->file('picture')->getClientOriginalExtension();
        $imageName = $request->title . '.' . $imageExt;
        $imageName = FileName::get($imageName, ['timestamp' => 'Y-m-dH:i:s']);
        $request->file('picture')->storeAs('comments', $imageName, 'public');

        Comment::query()->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $imageName
        ]);

        return redirect()->route('product.show', $product->id)->with('success', 'Comment added!');
    }

    public function update(Request $request, Comment $comment)
    {
        $newPictureName = $comment->picture;

        if ($request->file('picture')) {
            $imageExt = $request->file('picture')->getClientOriginalExtension();
            $newPictureName = $request->title . '.' . $imageExt;
            if ($comment->picture) {
                Storage::disk('public')->delete('comments/'. $comment->picture);
            }
            $newPictureName = FileName::get($newPictureName, ['timestamp' => 'Y-m-dH:i:s']);
            $request->file('picture')->storeAs('comments', $newPictureName, 'public');
        }

        $comment->update([
            'rating' => $request->rating_edit,
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $newPictureName
        ]);

        return redirect()->back()->with('success', 'Comment updated!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->picture) {
            Storage::disk('public')->delete('comments/'. $comment->picture);
        }
        $comment->delete();
        return redirect()->back()->with('danger', 'Comment deleted!');
    }
}
