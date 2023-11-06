<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorRegisterController extends Controller
{
   public function register_view(){
    return view('frontend.authorRegister.register');
   }

   public function register(Request $request){
     $request->validate([
           'name'=>'required',
           'email'=>'required|email',
           'password'=>'required',
     ]);
     User::insert([
       'name'=> $request->name,
       'email'=> $request->email,
       'password'=> bcrypt($request->password),
       'role'=> 'author',
       'as'=> 0,
       'created_at'=> now(),
     ]);
    //  $s_email =$request->email;
    //  $s_password =$request->password;

     return redirect()->route('author.login.view')->with('register_message','Your Registration Successful')->with('s_email',"$request->email")->with('s_password',"$request->password");
   }

   public function login_view(){
    return view('frontend.authorRegister.login');
   }

   public function login(Request $request){

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
       if(auth()->user()->as == 1){
             return view('dashboard.root.home');
       }else{
        return view('frontend.authorRegister.approve');
       }
    }else{
        return back()->with('unsuccessful_login','Please enter Correct Information');
    }

   }


//    this code for pending

public function pending_view(){
    return view('frontend.authorRegister.approve');
}
}
