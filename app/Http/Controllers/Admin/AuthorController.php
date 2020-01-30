<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = 'Authors';
        $authors = User::where('type', 2)->get();
        return view('admin.pages.authors.list', compact('page_name', 'authors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = " Author Create";
        $roles = Role::pluck('name', 'id');
        return view('admin.pages.authors.create', compact('page_name','roles'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|size:6',
            'role' => 'required|array',
            'role.*' => 'required|string'
        ],[
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'email.email' => 'Invalid email format',
            'email.unique' => 'User Email Already Exist',
            'password.required' => 'Password field is required',
            'password.size' => 'Password must be 6 characters or more',
            'role.required' => 'You must select role',
            'role.*.required' => 'You must select role'
        ]);

        $author = new User;
        $author->name = $request->input('name');
        $author->email = $request->input('email');
        $author->password = bcrypt($request->input('password'));
        $author->type = 2;
        $author->save();
        foreach($request->role as $value){
            $author->attachRole($value);
        }

        return redirect()->action('Admin\AuthorController@index')->with('success','Author Created Successfully');
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
        $page_name = "Author edit";
        $author = User::find($id);
        $role = Role::pluck('name','id');
        $selectedRole = DB::table('role_user')->where('user_id',$id)
                        ->pluck('role_id')->toArray();

        return view('admin.pages.authors.edit', compact('page_name','author','role', 'selectedRole'));
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
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|size:6',
            'role' => 'required|array',
            'role.*' => 'required|string'
        ],[
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'email.email' => 'Invalid email format',
            'password.required' => 'Password field is required',
            'password.size' => 'Password must be 6 characters or more',
            'role.required' => 'You must select role',
            'role.*.required' => 'You must select role'
        ]);

        $author = User::find($id);
        $author->name = $request->input('name');
        $author->email = $request->input('email');
        $author->password = bcrypt($request->input('password'));
        $author->save();
        DB::table('role_user')->where('user_id',$id)->delete();
        foreach($request->role as $value){
            $author->attachRole($value);
        }

        return redirect()->action('Admin\AuthorController@index')->with('success','Author Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->action('Admin\AuthorController@index')->with('success','Author Deleted Successfully');
    }
}
