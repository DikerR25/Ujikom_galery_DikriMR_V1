<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index',[
            "title" => "Index"
        ]);
    }

    public function profile(){
        $user = User::class;
        return view('pages.profile',[
            "title" => $user
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
}
