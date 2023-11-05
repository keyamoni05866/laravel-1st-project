<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FrontBlogsController extends Controller
{
        public function index(){
            $blogs = Blog::where('status','active')->latest()->paginate(5);
            return view('frontend.blogs.index', compact('blogs'));
        }
}
