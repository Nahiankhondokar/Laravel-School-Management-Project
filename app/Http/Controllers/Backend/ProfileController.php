<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // profile view page
    public function ProfileViewPage(){
        $id = Auth::user() -> id;
        $user = User::find($id);
        return view('backend.user.profile_view', [
            'user'      => $user
        ]);
    }

    // profile edit page
    public function ProfileEditPage(){
        $id = Auth::user() -> id;
        $user = User::find($id);
        return view('backend.user.profile_edit', [
            'user'      => $user
        ]);
    }


    // user profile update page
    public function ProfileUpdate($id, Request $request){

        // validation
        $this -> validate($request, [
            'name'          => 'required',
            'email'         => 'required',
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
        $updaet_data -> cell                = $request -> cell;
        $updaet_data -> address             = $request -> address;
        $updaet_data -> gender              = $request -> gender;
        $updaet_data -> user_type           = $request -> user_type;
        $updaet_data -> profile_photo_path  = $unique;
        $updaet_data -> update();
    

        // msg
        $notify = [
            'message'       => "User Profile Updated Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('profile.view') -> with($notify);
    }


    // profile password change page
    public function PasswordChangePage(){
        $id = Auth::user() -> id;
        $user = User::find($id);
        return view('backend.user.password_change_view');
    }

    // profile password update
    public function PasswordUpdate(Request $request){

        $id = Auth::user() -> id;
        $user = User::find($id);

        // validaiton
        $request -> validate([
            'old_pass'  => 'required',
            'new_pass'  => 'required',
            'password_confirmation' => 'required'
        ]);

        // password validation
        if(Hash::check($request -> old_pass, $user -> password) == false){
            // msg
            $notify = [
                'message'       => "Old password is wrong",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);
        } else if($request -> new_pass != $request -> password_confirmation){
            // msg
            $notify = [
                'message'       => "Password Not Match",
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);
        } else {

            $user -> password = Hash::make($request -> new_pass);
            $user -> update();
            Auth::logout();

        }
        

    }
    
    

    
}
