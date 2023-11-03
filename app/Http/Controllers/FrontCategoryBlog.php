<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FrontCategoryBlog extends Controller
{
    public function index($id){
        $blogs = Blog::where('category_id',$id)->get();
        return view('frontend.categoryPosts.index', compact('blogs'));
    }
    public function single($id){
        $blog = Blog::where('id',$id)->first();
        return view('frontend.singleBlog.index', compact('blog'));
    }
}
