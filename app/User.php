<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = "users";

    use SoftDeletes;

    public function posts(){

      return $this->hasMany('App\Post','user_id');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment','user_id');
    }

    public function like_details()
    {
      return $this->hasMany('App\Like_detail','user_id');
    }

    public function messages()
    {
      return $this->hasMany('App\Message','send_to_user_id');
    }

    public function friends()
    {
      return $this->hasMany('App\Friend','user_id');
    }
}
