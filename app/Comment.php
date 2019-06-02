<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    protected $table = "comments";
    use SoftDeletes;


    public function post()
    {
        return $this->belongsTo('App\Post','post_id');
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

    public function user()
    {
      return $this->belongsTo('App\User','user_id');
    }

    public function like_details()
    {
      return $this->hasMany('App\like_detail', 'comment_id');
    }



}
