<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Like_detail extends Model
{
  protected $table = "like_details";

  public function post()
  {
    return $this->belongsTo('App\post','post_id');
  }

  public function comment()
  {
    return $this->belongsTo('App\comment','comment_id');
  }

  public function user()
  {
    return $this->belongsTo('App\user','user_id');
  }



}
