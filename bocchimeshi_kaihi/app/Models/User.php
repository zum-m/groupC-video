<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Auth;
use Request;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'room_name',
        'room_open',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getOpenedRoomOrderByUpdated_at()
    {

        return self::where('room_open', 1)->get();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)
        ->withTimestamps();
    }
    public function mytags()
    {
        return $this->belongsToMany(Tag::class)
        ->withPivot('tag_id');
    }

    public static function roomStatusChange($room_status){
        $my_id = Auth::user()->id;
        $user=User::find($my_id);
        $user->room_open=$room_status;
        $user->save();
    }

    public static function myTagsName() {
        $my_id = Auth::user()->id;
        $tags_id = User::find($my_id)->mytags()->pluck('tag_id')->toArray();
        return Tag::find($tags_id)->pluck('name')->toArray();
    }

    public static function roomNameChange($room_name){
        $my_id = Auth::user()->id;
        $user=User::find($my_id);
        $user->room_name=$room_name;
        $user->save();
    }

}

