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
    //method untuk save comment ke database
    public function store(Request $request, Product $product, User $user)
    {
        //ambil extension gambar
        $imageExt = $request->file('picture')->getClientOriginalExtension();
        //nama file = title comment + extension
        $imageName = $request->title . '.' . $imageExt;
        //bikin nama file buat disimpan pake package
        $imageName = FileName::get($imageName, ['timestamp' => 'Y-m-dH:i:s']);
        //simpan gambar ke /public/storage/comments
        $request->file('picture')->storeAs('comments', $imageName, 'public');

        //save comment ke database
        Comment::query()->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $imageName
        ]);

        //redirect ke url: product/{id product? dengan pesan sukses
        return redirect()->route('product.show', $product->id)->with('success', 'Comment added!');
    }

    //update comment
    public function update(Request $request, Comment $comment)
    {
        //nama gambar = nama gambar yang ada di database
        $newPictureName = $comment->picture;

        //kalo user masukin gambar baru buat update gambar comment
        if ($request->file('picture')) {
            //ambil extension
            $imageExt = $request->file('picture')->getClientOriginalExtension();
            //set nama baru buat gambar, dari title comment + extension
            $newPictureName = $request->title . '.' . $imageExt;
            //kalo comment udah punya gambar sebelumnya
            if ($comment->picture) {
                //hapus gambar comment yang sebelumnya
                Storage::disk('public')->delete('comments/'. $comment->picture);
            }
            //set nama baru buat file pake package
            $newPictureName = FileName::get($newPictureName, ['timestamp' => 'Y-m-dH:i:s']);
            //save gambar ke /public/storage/comments
            $request->file('picture')->storeAs('comments', $newPictureName, 'public');
        }

        //update comment
        $comment->update([
            'rating' => $request->rating_edit,
            'title' => $request->title,
            'description' => $request->description,
            'picture' => $newPictureName
        ]);

        //redirect ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Comment updated!');
    }

    //hapus comment
    public function destroy(Comment $comment)
    {
        //kalo comment punya gambar
        if ($comment->picture) {
            //hapus gambar
            Storage::disk('public')->delete('comments/'. $comment->picture);
        }

        //hapus comment
        $comment->delete();

        //redirect ke halaman yang sama dengan pesan peringatan
        return redirect()->back()->with('danger', 'Comment deleted!');
    }
}
