<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;


class CommentController extends Controller
{
    public function add(Request $request,$id)
    {
        if($request->isMethod('get')){

            return view('subviews.get_comment_add',['id'=>$id]);

        } else {
            $user = Auth::user();

            $comment = new Comment();
            $comment->user_id = $user->id;

            $comment_id = $request->comment_id ?? null ;
            $comment->comment_id = $comment_id;

            $comment->post_id = $id;
            $comment->comment = $request->comment;
            $comment->edited_time = date('Y-m-d H:i:s');
            $comment->save();

            return redirect()->route('get_post_detail',['id'=>$id]);
        }
    }

    public function index($id)
    {
        $comments = Post::find($id)->comments();
        return view('subviews.get_comment_index',['comments' => $comments]);
    }

    public function delete(Request $request, $id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect()->route('get_post_detail',['id'=>$id]);
    }

    public function ignore()
    {
        $comment = Comment::find($comment_id);
        $comment->delete();
        return redirect()->route('get_post_detail',['id'=>$id]);
    }
}
