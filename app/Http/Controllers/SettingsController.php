<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $alls = User::all();
        $admins = User::where('role','admin')->get();
        $customers = User::where('role','customer')->get();
        return view('dashboard.settings.index', [
            'admins' => $admins,
            'customers' => $customers,
            'alls' => $alls,
        ]);
    }

    public function insert(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);


        if($request->name && $request->email && $request->password){
              User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'admin',
                'password' => bcrypt($request->password),
                'created_at' => now(),
              ]);
              return back()->with('success',"Dear $request->name, is promoted by ADMIN ");
        }
    }

    // role update

    public function role_update(Request $request){
                     User::findOrFail($request->user_name)->update([
                     'role' =>$request->role_name,
                     'updated_at'=> now()
                     ]);
                     return back();
    }
}
