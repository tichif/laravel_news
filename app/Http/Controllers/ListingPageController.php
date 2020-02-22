<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class ListingPageController extends Controller
{
    public function index($id){

        $posts = Post::with(['comments','creator','category'])
                       ->where('status',1)
                       ->where('category_id',$id)
                       ->orderBy('created_at', 'DESC')
                       ->paginate(5);

        $category = Category::find($id);

        return view('front.pages.listing', compact('posts','category'));
    }

    public function author($id){

        $posts = Post::with(['comments','creator','category'])
                       ->where('status',1)
                       ->where('created_by', $id)
                       ->orderBy('created_at', 'DESC')
                       ->paginate(5);
        
        $user = User::find($id);
        
        return view('front.pages.author', compact('posts','user'));
    }
}
