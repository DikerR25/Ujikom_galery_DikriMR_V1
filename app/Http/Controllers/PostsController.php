<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Posts;

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
}
