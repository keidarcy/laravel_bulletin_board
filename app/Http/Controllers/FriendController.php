<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Friend;


class FriendController extends Controller
{
    public function add($id)
    {
        $friend = new Friend();
        $friend->user_id = Auth::id();
        $friend->friend_id = $id;
        $friend->friend_flg = 0;
        $friend->save();
        return redirect()->route('get_post_index');
    }

    public function index()
    {
        $friends = Friend::unique_friend();
        return view('subviews.get_friend_index',['friends' => $friends]);
    }

    public function delete($id)
    {

        $friend = Friend::where('friend_id',$id)->where('user_id',Auth::id())->first();
        $friend->delete();
        return redirect()->route('get_friend_index');
    }

    public function ignore($id)
    {
        $friend = Friend::where('user_id',$id)->where('friend_id',Auth::id())->first();
        $friend->delete();
        return redirect()->route('get_friend_index');
    }



    public function accpet($id)
    {
        $friend = Friend::where('user_id',$id)->where('friend_id',Auth::id())->first();;
        $friend->friend_flg = 1;
        $friend->save();
        return redirect()->route('get_friend_index');
    }

}
