<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\Bio_user;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    public function index()
    {
        // Mengambil data post secara acak
        $posts = Posts::inRandomOrder()->get();

        // Mengambil user yang terkait dengan post
        $users = User::inRandomOrder()->get();

        return view('pages.index', compact('posts', 'users'))->with("title", "DikerR Gallery");
    }


    public function profile($username){
        $user = User::where('username', $username)->get();
        $posts = Posts::where('user_id', $user->first()->id)->get();
        $bio = Bio_user::all();
        return view('pages.profile',compact('user','bio','posts'),[
            "title" => $user->first()->username,
        ]);
    }

    public function viewimg($username,$id){
        $posts = Posts::where('id',$id)->get();
        $user = User::where('username', $username)->get();

        return view('pages.view-img', compact('posts','user'),[
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

    public function relationship(){
        return view('pages.relationship',[
            "title" => "Relationship"
        ]);
    }

    public function updateP(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:15000',
            'username' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user = User::find($id);

        // Perbarui username
        $user->username = $request->input('username');
        $user->description = $request->input('description');
        $user->save();

        if ($request->hasFile('img')) {
            // Hapus foto profil yang lama jika ada
            if ($user->img) {
                Storage::delete('public/profile_photos/' . $user->img);
            }

            // Simpan foto profil yang baru
            $newProfilePhoto = $request->file('img');
            $newProfilePhotoPath = $newProfilePhoto->store('public/profile_photos');
            $user->img = basename($newProfilePhotoPath);
            $user->save();
        }

        return redirect()->route('homepage')->with('success', 'Profil berhasil diperbaharui.');
    }


}
