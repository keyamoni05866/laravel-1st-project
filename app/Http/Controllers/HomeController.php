<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
             $author_requests= User::where( 'as',0)->orWhere('role','author')->get();

                if(auth()->user()->role == 'administrator' || auth()->user()->role == 'admin' )
                    {
                        return view('dashboard.root.home', compact('author_requests'));

                    }else{
                        return view('dashboard.profile.index');
                    }

    }
}
