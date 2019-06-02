<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Friend extends Model
{
    protected $table = "friends";

    use SoftDeletes;

    public function user()
    {
      return $this->belongsTo('App\User', 'user_id');
    }

    public static function unique_friend()
    {
        $friends = Friend::query()->where('user_id', Auth::id())->orwhere('friend_id',Auth::id())->orderBy('friend_flg','desc')->get();
        $unique_id = [];
        $unique = [];
        foreach ($friends as $index => $friend)
        {
            if (!in_array($friend->friend_id , $unique_id))
            {
                $unique_id[] = $friend->friend_id;
                $unique[] = $friend;
            }

        }
        return $friends;

    }

}
