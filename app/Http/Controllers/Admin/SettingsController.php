<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingsController extends Controller
{
    /* 
     *
     * @return \Illuminate\Http\Response 
    */
    public function index(){
        $page_name = "System Settings";
        $setting = Setting::find(1);
        $system_name = $setting->value;
        return view('admin.pages.settings.update', \compact('page_name','system_name'));
    }

    /* 
     *
     * @param Request $request
     * @return \Illuminate\Http\Response 
    */
    public function update(Request $request){
        $this->validate($request,[
            'name' => 'required'
        ],[
            'name.required' => 'The Name Field is required'
        ]);

        // Favicon 
        $fav_settings = Setting::find(2);
        if($request->file('favicon')){
            @unlink(public_path('/others'.$fav_settings->value));
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension();
            $favicon = 'favicon.'.$extension;
            //move 
            $file->move(public_path('/others'), $favicon);
            $fav_settings->value = $favicon;
            $fav_settings->save();
        }    
        
        // Front logo
        $front_settings = Setting::find(3);
        if($request->file('front_logo')){
            @unlink(public_path('/others'.$front_settings->value));
            $file = $request->file('front_logo');
            $extension = $file->getClientOriginalExtension();
            $front_logo = 'front_logo.'.$extension;
            //move 
            $file->move(public_path('/others'), $front_logo);
            $front_settings->value = $front_logo;
            $front_settings->save();
        }

        // Admin Logo
        $admin_settings = Setting::find(4);
        if($request->file('admin_logo')){
            @unlink(public_path('/others'.$admin_settings->value));
            $file = $request->file('admin_logo');
            $extension = $file->getClientOriginalExtension();
            $admin_logo = 'admin_logo.'.$extension;
            //move 
            $file->move(public_path('/others'), $admin_logo);
            $admin_settings->value = $admin_logo;
            $admin_settings->save();
        }

        $system_settings = Setting::find(1);
        $system_settings->value = $request->name;
        $system_settings->save();

        return redirect()->action('Admin\SettingsController@index')->with('success', 'System updated successfully');
    }
}
