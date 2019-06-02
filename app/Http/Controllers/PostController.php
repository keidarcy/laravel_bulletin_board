<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\user;
use Validator;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $posts = Post::orderBy('updated_at', 'desc')->search($request->keyword)->paginate(5);
        return view('index',['posts' => $posts]);
    }

    public function sort(Request $request)
    {
        if($request->sort == "1")
        {
            $posts = Post::orderBy('updated_at', 'desc')->paginate(5);
            return view('index',['posts' => $posts]);
        }

        if($request->sort == "2")
        {
            $posts = Post::orderBy('updated_at', 'asc')->paginate(5);
            return view('index',['posts' => $posts]);
        }

        if($request->sort == "3")
        {
            $posts = Post::orderBy('type', 'asc')->paginate(5);
            return view('index',['posts' => $posts]);
        }

        if($request->sort == "4")
        {
            $posts = Post::orderBy('user_id', 'asc')->paginate(5);
            return view('index',['posts' => $posts]);
        }
    }


    public function add(Request $request)
    {
        if($request->isMethod('get')){

            return view('get_post_add');

        } else
        {

            $validate_rules = [
                "title" => "required",
                "post" => "required",
                "type" => "required"
            ];

            $validator = validator::make($request->all(), $validate_rules);

            if($validator->fails()){
                return redirect()->route('get_post_add')->withErrors($validator)->withInput();
            }

            $user = Auth::user();

            $post = new Post();
            $post->user_id =$user->id;
            $post->title = $request->title;
            $post->post = $request->post;
            $post->type = $request->type;
            $post->video = $request->video;
            $post->edited_time = date('Y-m-d H:i:s');

            if($request->file('image')){
                $path = $request->file('image')->store('public/post');
                $post->image = str_replace("public", "storage", $path);
            }

            $post->save();
            return redirect()->route('get_post_detail',['id'=>$post->id]);

        }
    }

    public function detail(Request $request, $id)
    {
        $post = Post::find($id);
        return view('comment_and_post',["post" => $post]);
    }

    public function edit(Request $request, $id)
    {
        if($request->isMethod('get')){
            $post = Post::find($id);
            return view('get_post_edit',["post" => $post]);
        } else
        {

            $validate_rules = [
                "title" => "required",
                "post" => "required",
                "type" => "required"
            ];

            $validator = validator::make($request->all(), $validate_rules);

            if($validator->fails()){
                return redirect()->route('get_post_edit')->withErrors($validator)->withInput();
            }


            $post = Post::find($id);
            $post->title = $request->title;
            $post->post = $request->post;
            $post->type = $request->type;

            if($request->file('image')){
                $path = $request->file('image')->store('public/post');
                $post->image = str_replace("public", "storage", $path);
            }

            $post->save();
            return redirect()->route('get_post_detail',['id'=>$post->id]);
        }
    }

    public function delete(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route("get_post_index");
    }


    public function index_order_by_user($username)
    {
        // nameがある時、このnameのpostsを探す方法
        $posts = Post::where('user_id', User::where('name',$username)->get()->first()->id)->paginate(5);
        // $posts = User::where('name',$username)->first()->posts()->paginate(5);
        return view('index',['posts'=>$posts, 'username'=>$username]);
    }

    public function index_order_by_type($type)
    {
        $posts = Post::where('type', $type)->paginate(5);
        return view('index',['posts'=> $posts]);
    }

    public function nowtime()
    {
        $time =[];
        $time['time'] = date('Y-m-d H:i:s');
        return $time;
    }

}
