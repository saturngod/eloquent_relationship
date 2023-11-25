<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    function users() {
        return $this->hasMany(User::class);
    }

    function posts() {
        return $this->hasManyThrough(Post::class,User::class);
    }
}
