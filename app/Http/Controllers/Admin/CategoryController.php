<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "Category List";
        $data = Category::all();
        return view('admin.pages.categories.list', compact('page_name', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = 'Category create';
        return view('admin.pages.categories.create', compact('page_name'));
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
            'name' => 'required'
        ], [
            'name.required' => 'The Name Field is required'
        ]);

        $category = new Category;
        $category->name = $request->input('name');
        $category->status = 1;
        $category->save();

        return redirect()->action('Admin\CategoryController@index')->with('success','Category created successfully');
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
        $page_name = 'Edit category';
        $category = Category::find($id);
        return view('admin.pages.categories.edit', compact('page_name', 'category'));
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
            'name' => 'required'
        ], [
            'name.required' => 'The Name Field is required'
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect()->action('Admin\CategoryController@index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->action('Admin\CategoryController@index')->with('success','Category deleted successfully ');
    }

    /**
     * Change status of a category
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function status($id){
        $category = Category::find($id);

        if($category->status === 1){
            $category->status = 0;
            $category_status = 'unpublish successfully';
        }else{
            $category->status = 1;
            $category_status = 'publish successfully';
        }

        $category->save();
        return redirect()->action('Admin\CategoryController@index')->with('success','Category '.$category_status);
    }
}
