<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $feature_blogs = Blog::where('feature','active')->get();
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        $blogs = Blog::where('status','active')->latest()->paginate(4);
        $popular_blogs = Blog::where('status', 'active')->orderBy('visitor_count','desc')->take(3)->get();

        return view('frontend.root.index',[
           'feature_blogs' => $feature_blogs,
           'categories' => $categories,
           'popular_blogs' => $popular_blogs,
           'blogs' => $blogs,
           'tags' => $tags,
        ]);
    }
}
