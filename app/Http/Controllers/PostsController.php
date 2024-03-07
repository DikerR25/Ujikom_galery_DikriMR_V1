<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Posts;
use App\Models\Like;
use App\Models\Relationship;
use App\Models\Comment;

class PostsController extends Controller
{
    public function posts(Request $request)
    {
        $this->validate($request, [
            'user_id'   => 'required',
            'image'     => 'required|image|mimes:png,jpg,jpeg,gif',
            'title'     => 'required',
            'caption'   => 'required',
            'category'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $posts = Posts::create([
            'user_id'   => $request->user_id,
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'caption'   => $request->caption,
            'category'   => $request->category,
        ]);

        if($posts){
            //redirect dengan pesan sukses
            return redirect()->route('homepage')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('homepage')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function likePost(Request $request, $postId)
    {
        Like::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
        ]);

        $likeCount = Like::where('post_id', $postId)->count();

        Posts::where('id', $postId)->update([
            'like' => $likeCount,
        ]);

        return back();
    }

    public function unlikePost(Request $request, $postId)
    {
        Like::where('user_id', auth()->id())
            ->where('post_id', $postId)
            ->delete();

        $likeCount = Like::where('post_id', $postId)->count();

        Posts::where('id', $postId)->update([
            'like' => $likeCount,
        ]);

        return back();
    }

    public function addfriend(Request $request, $id)
    {
        Relationship::create([
            'user_id1' => auth()->id(),
            'user_id2' => $id,
        ]);

        return back();
    }

    public function unfriend(Request $request, $id)
    {
        Relationship::where('user_id1' , auth()->id())
            ->where('user_id2' , $id,)
            ->delete();

        return back();
    }

    public function komen(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'comment' => $request->comment
        ]);

        $commentCount = Comment::where('post_id', $postId)->count();

        Posts::where('id', $postId)->update([
            'comment' => $commentCount,
        ]);

        return back();
    }

}
