<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->orderBy('order','ASC')->get();
        
        return view('post',compact('posts'));
    }

    public function update(Request $request)
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
}