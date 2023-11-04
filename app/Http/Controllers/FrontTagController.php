<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class FrontTagController extends Controller
{
public function index($id){
       $tag_name = Tag::where('id',$id)->first();
       $tag = Tag::with('manyrelationblogs')->where('id',$id)->get();
       $blogs= $tag[0]->manyrelationblogs;
    return view('frontend.tagPosts.index',compact('blogs','tag_name'));

}
}
