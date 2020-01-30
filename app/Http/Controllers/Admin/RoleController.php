<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_name = "Role Page";
        $data = Role::all();
        return view('admin.pages.roles.list', compact('page_name', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_name = "Role Create";
        $permission = Permission::pluck('name','id');
        return view('admin.pages.roles.create', compact('page_name', 'permission'));
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
            'permission' => 'required|array',
            'permission.*' => 'required|string'
        ],[
            'name.required' => 'Name field is required',
            'permission.required' => 'You must select permission',
            'permission.*.required' => 'You must select permission'
        ]);

        $role = new Role;
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        foreach($request->permission as $value){
            $role->attachPermission($value);
        }

        return redirect()->action('Admin\RoleController@index')->with('success','Role created successfully');
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
        $page_name = "Role Edit";
        $role = Role::find($id);
        $permission = Permission::pluck('name','id');
        $selectedPermission = DB::table('permission_role')->where('permission_role.role_id',$id)
                                ->pluck('permission_id')->toArray();
        return view('admin.pages.roles.edit', compact('page_name','role','permission','selectedPermission'));
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
            'permission' => 'required|array',
            'permission.*' => 'required'
        ],[
            'name.required' => 'Name field is required',
            'permission.required' => 'You must select permission',
            'permission.*.required' => 'You must select permission'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();
        //you must delete the permissions for update the table
        DB::table('permission_role')->where('role_id',$id)->delete();
        foreach($request->permission as $value){
            $role->attachPermission($value);
        }

        return redirect()->action('Admin\RoleController@index')->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id',$id)->delete();
        return redirect()->action('Admin\RoleController@index')->with('success','Role deleted successfully');

    }
}
