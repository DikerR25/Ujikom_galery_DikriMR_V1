<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Posts;
use App\Models\Like;

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

    public function toggleLike(Request $request)
    {
        $existingLike = Like::where('user_id', $request->user_id)
                            ->where('post_id', $request->post_id)
                            ->first();

        if ($existingLike) {
            // Unlike jika sudah memberikan like sebelumnya
            $existingLike->delete();
            $likeCount = Like::where('post_id', $request->post_id)->count();
            return response()->json(['message' => 'Unlike berhasil', 'likeCount' => $likeCount]);
        } else {
            // Like jika belum memberikan like sebelumnya
            $like = new Like();
            $like->user_id = $request->user_id;
            $like->post_id = $request->post_id;
            $like->save();
            $likeCount = Like::where('post_id', $request->post_id)->count();
            return response()->json(['message' => 'Like berhasil', 'likeCount' => $likeCount]);
        }
    }
}
