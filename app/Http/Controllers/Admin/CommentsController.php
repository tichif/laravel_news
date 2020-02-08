<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $page_name= "Comments";
        $data = Comment::with(['post'])
                        ->where('post_id',$id)
                        ->orderBy('id','DESC')
                        ->get(); 
        return view('admin.pages.comments.list', compact('page_name', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $page_name = 'Comment reply';
        return view('admin.pages.comments.reply', compact('page_name','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "comment" => 'required',
            "post_id" => "required"
        ],[
            'comment.required' => 'Comment field cannot be empty'
        ]);

        $comment = new Comment;
        $comment->name = Auth::user()->name;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->status = 0;
        $comment->save();

        return redirect()->route('comment-list',['id' => $request->post_id])->with('success','Comment replied successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /* 
     *
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function status($id){

        $comment = Comment::find($id);

        if($comment->status === 1){
            $comment->status = 0;
            $comment_status = 'unpublished successfully';
        }else{
            $comment->status = 1;
            $comment_status = 'published successfully';
        }

        $comment->save();
        return redirect()->route('comment-list',['id' => $comment->post_id])->with('success','Comment '.$comment_status);
    }
}
