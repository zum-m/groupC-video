<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public function users()
    {
        return $this->belongToMany(User::class)
        ->withTimestamps();
        // ->using(Tag_User::class)
        // ->withPivot('user_id');
    }


    public function store()
    {
        $tags=Tag::create([
            'name' => $request->tag,
        ]);
    }




    
}



