<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\Bio_user;
use App\Models\Like;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    public function index()
    {
        $posts = Posts::inRandomOrder()->get();
        $users = User::inRandomOrder()->get();

        return view('pages.index', compact('posts', 'users'))->with("title", "DikerR Gallery");
    }


    public function profile($username){
        $user = User::where('username', $username)->get();
        $posts = Posts::where('user_id', $user->first()->id)->orderBy('created_at', 'desc')->get();
        $bio = Bio_user::all();
        $totla_posts = Posts::where('user_id', $user->first()->id)->count();
        $likeCountP = Like::where('user_id', $user->first()->id)->count();

        return view('pages.profile',compact('user','bio','posts','totla_posts','likeCountP'),[
            "title" => $user->first()->username,
        ]);
    }

    public function viewimg($username, $id){
        $posts = Posts::where('id', $id)->get();
        $user = User::where('username', $username)->get();
        $like = Like::where('post_id', $id)->get();
        $likeCount = Like::where('post_id', $id)->count();
        $firstPost = $posts->first();
        $firstLike = $like->first();
        $likePostId = $firstLike ? $firstLike->post_id : null;

        return view('pages.view-img', compact('posts', 'user', 'likeCount'), [
            "title" => $user->first()->username,
            "like" => $likePostId,
        ]);
    }


    public function post(){
        return view('pages.post-page',[
            "title" => "post"
        ]);
    }

    public function explore(){
        return view('pages.explore',[
            "title" => "exprole"
        ]);
    }

    public function relationship(){
        return view('pages.relationship',[
            "title" => "Relationship"
        ]);
    }

    public function updateP(Request $request, $id)
    {
        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15000',
            'username' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = User::find($id);

        $user->username = $request->input('username');
        $user->description = $request->input('description');
        $user->save();

        if ($request->hasFile('img')) {
            if ($user->img) {
                Storage::delete('public/profile_photos/' . $user->img);
            }

            $newProfilePhoto = $request->file('img');
            $newProfilePhotoPath = $newProfilePhoto->store('public/profile_photos');
            $user->img = basename($newProfilePhotoPath);
            $user->save();
        }

        return redirect()->route('homepage')->with('success', 'Profil berhasil diperbaharui.');
    }

    public function update_post(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'caption' => 'nullable|string',
        ]);

        $post = Posts::find($id);

        if (!$post) {
            return redirect()->back()->with('error', 'Post tidak ditemukan.');
        }

        $post->title = $request->input('title');
        $post->caption = $request->input('caption');
        $post->save();

        return redirect()->route('homepage')->with('success', 'Proses berhasil.');
    }

    public function delete_post($id)
    {
        $posts = Posts::findOrFail($id);
        Storage::disk('local')->delete('public/posts/'.$posts->image);
        $posts->delete();

        if($posts){
            return redirect()->route('homepage')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            return redirect()->route('homepage')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

}
