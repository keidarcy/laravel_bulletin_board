<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\like_detail;

class Like_detailController extends Controller
{

  public function add($id, $like, $place, $username = "default")
  {
    if($place == 'detail')
    {
        $user = Auth::user();

        $like_detail = new Like_detail();
        $like_detail->post_id = $id;
        $like_detail->user_id = $user->id;
        $like_detail->mtb_like_dislike_id = $like;
        $like_detail->save();

        return redirect()->route('get_post_detail',['id'=>$id]);

    } elseif($username == "default")
    {
          $user = Auth::user();

          $like_detail = new Like_detail();
          $like_detail->post_id = $id;
          $like_detail->user_id = $user->id;
          $like_detail->mtb_like_dislike_id = $like;
          $like_detail->save();

          return redirect()->route('get_post_index');

      } elseif(isset($username))
      {

        $user = Auth::user();

        $like_detail = new Like_detail();
        $like_detail->post_id = $id;
        $like_detail->user_id = $user->id;
        $like_detail->mtb_like_dislike_id = $like;
        $like_detail->save();

        return redirect()->route('get_post_order_by_user', ['username' => $username]);

    }


  }


  public function add_to_comment($id, $like, $comment_id)
  {

        $user = Auth::user();

        $like_detail = new Like_detail();
        $like_detail->comment_id = $comment_id;
        $like_detail->user_id = $user->id;
        $like_detail->mtb_like_dislike_id = $like;
        $like_detail->save();

        return redirect()->route('get_post_detail',['id'=>$id]);
  }



}
