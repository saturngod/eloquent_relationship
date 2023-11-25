<?php
namespace App\Models;

trait PostablePost {
    function post() {
        return $this->morphOne(Post::class,"postable");
    }
}