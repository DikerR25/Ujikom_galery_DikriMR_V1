<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\Bio_user;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Relationship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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
        $totalLikes = Like::whereIn('post_id', $posts->pluck('id'))->count();
        $bio = Bio_user::all();
        $totalPosts = Posts::where('user_id', $user->first()->id)->count();
        $relationship = Relationship::where('user_id1', $user->first()->id)->count();

        return view('pages.profile',compact('user','bio','posts','totalPosts','totalLikes','relationship'),[
            "title" => $user->first()->username,
        ]);
    }


    public function viewimg($username, $id){
        $posts = Posts::where('id', $id)->get();
        $users = User::all();
        $user = User::where('username', $username)->get();
        $liked = Like::where('user_id', auth()->id())
                     ->where('post_id', $id)
                     ->exists();

        $likeCount = Like::where('post_id', $id)->count();
        $commentCount = Comment::where('post_id', $id)->count();
        $comment = Comment::where('post_id', $id)->get();


        return view('pages.view-img', compact('posts', 'user', 'likeCount', 'users','liked','comment','commentCount'), [
            "title" => $user->first()->username,
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

    public function allusers(Request $request)
    {
        $query = $request->get('query');
        $results = User::where('username', 'LIKE', "%{$query}%")->get();
        return view('pages.explore', compact('results'),[
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
