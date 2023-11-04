<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontCategoryBlog extends Controller
{
    public function index($id){
        $blogs = Blog::where('category_id',$id)->get();
        $category_blog = Category::where('id',$id)->first();
        return view('frontend.categoryPosts.index', compact('blogs','category_blog'));
    }
    public function single($id){
        $blog = Blog::where('id',$id)->first();

        if($blog){
            Blog::find($id)->update([
              'visitor_count' => $blog->visitor_count  + 1,
            ]);
        }
        return view('frontend.singleBlog.index', compact('blog'));
    }
}
