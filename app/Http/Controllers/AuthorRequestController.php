<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorRequestController extends Controller
{
     public function accept($id){
              $author = User::where('id',$id)->first();
              if($author->as == 0){
                User::find($id)->update([
                 'as' => 1,
                 'updated_at' => now(),
                ]);
                return back();
              }
     }
     public function reject($id){
              $author = User::where('id',$id)->first();
              if($author->as == 0){
                User::find($id)->delete();
                return back();
              }
     }
}
