<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


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
        // $open = self::where('room_open', 0);
        // return $open::orderBy('updated_at', 'desc')->get();
        // return self::orderBy('updated_at', 'desc')->get();
        return self::where('room_open', 0)->get();
    }

    public function tags()
    {
        return $this->belongToMany(Tag::class)
        ->withTimestamps();
        // ->using(Tag_User::class)
        // ->withPivot('tag_id');
    }
    public function mytags()
    {
        return $this->belongToMany(Tag::class)
        // ->using(Tag_User::class)
        ->withPivot('tag_id');
    }

}

