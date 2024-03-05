<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bio_user;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index',[
            "title" => "Index"
        ]);
    }

    public function profile($username){
        $user = User::where('username', $username)->get();
        $bio = Bio_user::all();
        return view('pages.profile',compact('user','bio'),[
            "title" => $user->first()->username,
        ]);
    }

    public function viewimg(){

        return view('pages.view-img',[
            "title" => "view"
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

        // Mencari atau membuat record Bio_User
        // $bioUser = User::updateOrCreate(
        //     ['id' => $user->id],
        //     ['description' => $request->input('description')]
        // );

        return redirect()->route('homepage')->with('success', 'Profil berhasil diperbaharui.');
    }


}
