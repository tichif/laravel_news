<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use DB;
use App\Category;
use Image;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Posts List';
        if(Auth::user()->type === 1 || Auth::user()->hasRole('Editor')){
            $data = Post::with(['creator'])
                        ->orderBy('created_at','DESC')->get();
        }else{
            $data = Post::with(['creator'])
                        ->where('created_by', Auth::user()->id)
                        ->orderBy('created_at','DESC')
                        ->get();
        }
        return view('admin.pages.posts.list', compact('page_name', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'Post Create';
        $categories = Category::where('status',1)->pluck('name','id');
        return view('admin.pages.posts.create', compact('page_name','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required',
            'short_description'=> 'required',
            'description'=> 'required',
            'category_id'=> 'required',
            'image'=> 'required|image',
        ],[
            'title.required' => 'Title must be filled.',
            'short_description.required' => 'Short description must be filled.',
            'description.required' => 'Description must be filled.',
            'category_id.required' => 'Category must be filled.',
            'image.required' => 'Image must be filled.'
        ]);


        $post = new Post;        
        $post->title = $request->title;
        $post->slug = str_slug($request->title, '-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->created_by = Auth::user()->id;
        $post->status = 1;
        $post->hot_news = 0;
        $post->view_count = 0;
        $post->main_image = '';
        $post->thumb_image = '';
        $post->list_image = '';
        $post->save();

        //Image 
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $main_image = 'post_main_'.$post->id.'.'.$extension;
        $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
        $list_image = 'post_list_'.$post->id.'.'.$extension;
        Image::make($file)->resize(653,569)->save(public_path('/posts/'.$main_image));
        Image::make($file)->resize(360,309)->save(public_path('/posts/'.$list_image));
        Image::make($file)->resize(122,122)->save(public_path('/posts/'.$thumb_image));
        $post->main_image = $main_image;
        $post->thumb_image = $thumb_image;
        $post->list_image = $list_image;
        $post->save();

        return redirect()->action('Admin\PostsController@index')->with('success','Post created successfully');

        
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
        $page_name = "Edit Post";
        $post = Post::find($id);
        $categories = Category::where('status',1)->pluck('name','id');
        return view('admin.pages.posts.edit', compact('page_name', 'post','categories'));
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
        $this->validate($request, [
            'title'=> 'required',
            'short_description'=> 'required',
            'description'=> 'required',
            'category_id'=> 'required',
        ],[
            'title.required' => 'Title must be filled.',
            'short_description.required' => 'Short description must be filled.',
            'description.required' => 'Description must be filled.',
            'category_id.required' => 'Category must be filled.',
        ]);


        $post = Post::find($id);
        if($request->file('image')){

            //delete old images
            @unlink(public_path('/posts'.$post->main_image));
            @unlink(public_path('/posts'.$post->thumb_image));
            @unlink(public_path('/posts'.$post->list_image));

            //add new images
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $main_image = 'post_main_'.$post->id.'.'.$extension;
            $thumb_image = 'post_thumb_'.$post->id.'.'.$extension;
            $list_image = 'post_list_'.$post->id.'.'.$extension;
            Image::make($file)->resize(653,569)->save(public_path('/posts/'.$main_image));
            Image::make($file)->resize(360,309)->save(public_path('/posts/'.$list_image));
            Image::make($file)->resize(122,122)->save(public_path('/posts/'.$thumb_image));
            $post->main_image = $main_image;
            $post->thumb_image = $thumb_image;
            $post->list_image = $list_image;

        }        
        $post->title = $request->title;
        $post->slug = str_slug($request->title, '-');
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->category_id = $request->category_id;

        $post->save();

        return redirect()->action('Admin\PostsController@index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        @unlink(public_path('/posts'.$post->main_image));
        @unlink(public_path('/posts'.$post->thumb_image));
        @unlink(public_path('/posts'.$post->list_image));
        $post->delete();
        return redirect()->action('Admin\PostsController@index')->with('success','Post deleted successfully');
    }

    /**
     * Change status of a post
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id){
        $post = Post::find($id);

        if($post->status === 1){
            $post->status = 0;
            $post_status = 'unpublished successfully';
        }else{
            $post->status = 1;
            $post_status = 'published successfully';
        }

        $post->save();
        return redirect()->action('Admin\PostsController@index')->with('success','Post '.$post_status);
    }


    /**
     * Put a post like a hot-news or not
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function hot_news($id){
        $post = Post::find($id);

        if($post->hot_news === 1){
            $post->hot_news = 0;
            $post_status = 'unset at hot news successfully';
        }else{
            $post->hot_news = 1;
            $post_status = 'set at hot news successfully';
        }

        $post->save();
        return redirect()->action('Admin\PostsController@index')->with('success','Post '.$post_status);
    }
}
