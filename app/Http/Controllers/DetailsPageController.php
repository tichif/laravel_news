<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class DetailsPageController extends Controller
{
    public function index($slug){

        $post = Post::with(['creator','comments','category'])
                    ->where('status',1)
                    ->where('slug',$slug)
                    ->first();
        
        $post->view_count = $post->view_count +1;
        $post->save();

        $post_id = $post->id ;

        $related_news =  Post::with(['creator','comments','category'])
                             ->where('status',1)
                             ->where('id','!=', $post->id)
                             ->where('category_id',$post->category_id)
                             ->orderBy('created_at','DESC')
                             ->limit(4)
                             ->get();

                             
        $comments = Comment::where('post_id',$post->id)
                            ->get();                    

        return view('front.pages.details', compact('post', 'related_news','comments','post_id'));
    }

    public function comment(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'comment' => 'required',
            'post_id' => 'required',
        ],[
            'name.required' => 'The name field cannot be blank',
            'comment.required' => 'The name field cannot be blank',
        ]);

        $comment = new Comment;
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->status = 1;
        $comment->save();

        return back();
    }
}
