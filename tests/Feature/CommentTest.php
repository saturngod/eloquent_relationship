<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_comment(): void
    {
        $user = User::factory()->create();
        $comment_user = User::factory()->create();
        $post = Post::factory(["user_id" => $user->id])->create();

        Comment::factory(["user_id" => $comment_user->id,"post_id" => $post->id])->create();

        $this->assertEquals(1,Comment::count());
        $this->assertEquals($comment_user->id,Comment::first()->user->id);
        $this->assertEquals($post->id,Comment::first()->post->id);
        
    }
}
