<?php
namespace App\Models;

trait LikeableRealation {
    function like(User $user) {
        $this->likes()->attach($user);
    }

    function likes() {
        return $this->morphToMany(User::class,"likes")->withTimestamps();
    }
}