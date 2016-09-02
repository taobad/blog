<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    //
    public function getIndex(){
        $posts = Post::orderBy('created_at','desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout()
    {
        $posts = Post::all();
        return view('pages.about');
    }

    public function getContact()
    {
        $posts = Post::all();
        return view('pages.contact');
    }
}
