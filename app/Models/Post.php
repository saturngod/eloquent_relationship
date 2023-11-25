<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;
    use LikeableRealation;

    function user() {
        return $this->belongsTo(User::class);
    }

    function tags() {
        return $this->belongsToMany(Tag::class);
    }

    function postable() {
        return $this->morphTo();
    }

    
}
