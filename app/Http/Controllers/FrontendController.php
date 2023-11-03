<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $feature_blogs = Blog::where('feature','active')->get();
        $categories = Category::latest()->get();
        return view('frontend.root.index',[
           'feature_blogs' => $feature_blogs,
           'categories' => $categories,
        ]);
    }
}
