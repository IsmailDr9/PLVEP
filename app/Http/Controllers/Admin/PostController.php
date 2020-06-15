<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index',compact('posts'));
    }

    public function store(Request $request)
    {
        $rules = $this->validate($request,[

            'title'=>'required',
            'body'=>'required',

        ]);
//        $validator = Validator::make(input::all(), $rules);
//        if ($validator->fails())
//        {
//            return response()->json(array('errors'=>$validator->getMessageBag()->toArray()));
//
//        }else{

            $att = $request->post();
            $post = Post::create($att);
            return response()->json($post);

//        }
    }

    public function editPost(Request $request){
        $this->validate($request,[

            'title'=>'required',
            'body'=>'required',

        ]);
        $post = Post::find ($request->id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return response()->json($post);
    }

    public function deletePost(Request $request){
        $post = Post::find ($request->id)->delete();
        return response()->json();
    }
}
