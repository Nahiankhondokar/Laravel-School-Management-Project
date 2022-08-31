<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // user view page
    public function UserViewPage(){
        $user = User::all();
        return view('backend.user.user_view', [
            'user'  => $user
        ]);
    }

    // user add page
    public function UserCreatePage(){
        return view('backend.user.user_create');
    }

    // user add page
    public function UserStore(Request $request){

        // validation
        $this -> validate($request, [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required',
            'user_type'  => 'required'
        ], [
            'user_type.required'    => "User Type is required"
        ]);

        // img upload 
        if($request -> hasFile('file')){

            $img = $request -> file('file');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/user'), $unique);

        }

        // user store
        User::insert([
            'name'            => $request -> name,
            'email'           => $request -> email,
            'password'        => Hash::make($request -> password),
            'user_type'       => $request -> user_type,
            'profile_photo_path'=> $unique
        ]);

        // msg
        $notify = [
            'message'       => "User Created Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('user.view') -> with($notify);
    }


    // user view page
    public function UserEditPage($id){
        
        $user = User::findOrFail($id);
        return view('backend.user.user_edit', [
            'user'  => $user
        ]);
    }


    // user update page
    public function UserUpdate($id, Request $request){

        // validation
        $this -> validate($request, [
            'name'          => 'required',
            'email'         => 'required|unique:users',
            'user_type'     => 'required'
        ]);

        // img upload 
        if($request -> hasFile('file')){

            $img = $request -> file('file');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/user'), $unique);

            if(file_exists('media/user/' . $request -> old_img)){
                unlink('media/user/' . $request -> old_img);
            }


        }else {
            $unique = $request -> old_img;
        }

        // user store
        $updaet_data = User::find($id);
        $updaet_data -> name                = $request -> name;
        $updaet_data -> email               = $request -> email;
        $updaet_data -> user_type           = $request -> user_type;
        $updaet_data -> profile_photo_path  = $unique;
        $updaet_data -> update();
    

        // msg
        $notify = [
            'message'       => "User Updated Succefully",
            'alert-type'    => "info"
        ];

        return redirect() -> route('user.view') -> with($notify);
    }
    

            // user view page
    public function UserDelete($id){
        
        $user = User::findOrFail($id);
        $user -> delete();

        // msg
        $notify = [
            'message'       => "User Deleted Succefully",
            'alert-type'    => "error"
        ];

        return redirect() -> route('user.view') -> with($notify);
    
    }

    
}
