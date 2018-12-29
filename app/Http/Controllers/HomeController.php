<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        return view('home');
    }

    public function privacy()
    {
        return view('privacy');
    }
    // public function search($searchkey)
    // {
    //     $posts = Post::search($searchkey)->get();
    //     return view('search', compact('posts'));
    // }
    
}
