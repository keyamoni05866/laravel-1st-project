<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
         public function index(){
            $tags=Tag::where('user_id', auth()->id())->paginate(4);
            return view('dashboard.tag.index',compact('tags'));
         }

        //  insert
         public function insert(Request $request){
          $request->validate([
                'title' => 'required',
          ]);

          Tag::insert([
                  'title'=> $request->title,
                  'user_id'=> auth()->id(),
                  'created_at'=> now(),
          ]);

          return back();

         }

        //  status change

         public function status( $id){
          $tag = Tag::where('id',$id)->first();

          if($tag->status == 'active'){
            Tag::find($id)->update([
                'status'=> 'deactive',
                'created_at'=> now(),
        ]);
        return back();
          }else{
            Tag::find($id)->update([
                'status'=> 'active',
                'created_at'=> now(),
        ]);
        return back();
          }

    }

    // soft delete

    public function delete($id){
        Tag::find($id)->delete();
        return back();
    }

    // update

    public function update(Request $request,$id){
        Tag::find($id)->update([
            'title' => $request->title,
        ]);
        return back();
    }
}
