<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
  protected $table = "posts";

  use SoftDeletes;

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function comments()
  {
    return $this->hasMany('App\Comment','post_id')->orderBy('comment_id', 'desc')->orderBy('created_at', 'desc');
  }


  public function time_diff($id)
  {
    $post_time = self::find($id)->updated_at;
    $diff = date_diff(date_create(date("Y-m-d H:i:s")),date_create($post_time));
    $month = $diff->m;
    $day = $diff->d;
    $hour = $diff->h;
    $minute = $diff->i;
    $second = $diff->s;

    if($month >1){
      return $month."months before";
    } elseif($month == 1){
      return "1 month before";
    } elseif($day > 1){
      return $day."days before";
    } elseif($day == 1){
      return "1 day before";
    }elseif ($hour > 1){
      return $hour."hours before";
    }elseif($minute > 1){
      return $minute."minutes before";
    }elseif($minute == 1){
      return "1 mintute before";
    }else {
      return "just now";
    }

  }

  public function like_details()
  {
    return $this->hasMany('App\like_detail', 'post_id');
  }


  public function get_like_user_image($id)
  {
    $post = self::find($id);
    $user = array();
    foreach($post->like_details()->where('mtb_like_dislike_id',2)->get() as $like_record)
    {
      $user[] = user::find($like_record->user_id)->image;
    }
      return $user;
  }

  public static function scopeSearch($query, $keyword)
  {
    return $query->where('title', 'like', '%'. $keyword . '%')
    ->orWhere('type', 'like', '%'. $keyword . '%');
  }

  public function count_one_type($type)
  {
    $posts = Post::where('type', $type)->get();
    return count($posts);
  }

}
