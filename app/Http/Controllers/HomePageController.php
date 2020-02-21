<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomePageController extends Controller
{
    public function index(){

        $hot_news = Post::with('creator')
                        ->withCount('comments')
                        ->where('hot_news',1)
                        ->where('status',1)
                        ->orderBy('id','DESC')
                        ->first();

        $top_viewed = Post::with('creator')
                         ->withCount('comments')
                         ->where('status',1)
                         ->orderby('view_count','DESC')
                         ->limit(2)
                         ->get();

        $category_posts = Category::with('posts')
                                  ->where('status',1)
                                  ->orderBy('id','DESC')
                                  ->limit(5)
                                  ->get();

        return view('front.pages.home', compact('hot_news','top_viewed','category_posts'));
    }
}
