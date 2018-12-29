<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	if($request->has('search')){
    		$users = User::search($request->get('search'))->get();	
    	}else{
    		$users = User::get();
    	}
        return view('search', compact('users'));
    }
    
    public function postList(Request $request)
    {
        if($request->has('search')){
            $posts = Post::search($request->search)
                ->paginate(6);
        }else{
            $posts = Post::paginate(6);
        }
        return view('post-search',compact('posts'));
    }
}