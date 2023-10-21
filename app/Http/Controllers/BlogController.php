<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::paginate(2);
        $trashes = Blog::onlyTrashed()->get();
        return view('dashboard.blog.index',compact('blogs','trashes'));
    }
    public function insert_view(){
        $categories = Category::all();
        $tags = Tag::where('status','active')->get();
        return view('dashboard.blog.insert',compact('categories','tags'));
    }

    // database insert
    public function insert(Request $request){

        $new_name = auth()->id().'-'.$request->title.'-'.now()->format('d-m-Y').'.'.$request->file('image')->getClientOriginalExtension();

        $img = Image::make($request->file('image'))->resize(300, 200);
        $img->save(base_path('public/uploads/blog/'.$new_name), 60);

        if($request->hasFile('image')){
          $blog =  Blog::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $new_name,
                'date' => $request->date,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
                'created_at' => now()
             ]);
        }
        $blog->ManyRelationTags()->attach($request->ids);
        $blog->save();

        return redirect()->route('blog');
    }


    // delete

    public function delete($id){
           Blog::find($id)->delete();

           return back()->with('delete_success','Blog Deleted Successfully');
    }

    // Restore
    public function restore($id){
        Blog::withTrashed()->where('id',$id)->restore();
        return back();
    }

    // Restore Delete

    public function restore_delete($id){
      Blog::where('id',$id)->forceDelete();
        // $blogs->save();
        return back();
    }
}
