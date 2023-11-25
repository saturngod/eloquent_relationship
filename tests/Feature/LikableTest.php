<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\TextPost;

class LikableTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_like_post(): void
    {
        $user = User::factory()->create();

        $text = TextPost::factory()->create();
        $post = Post::factory([
            "user_id" => $user->id,
            'postable_id' => $text->id,
            'postable_type' => TextPost::class
        ])->create();

        $likeUser = User::factory()->create();

        $post->like($likeUser);

        $this->assertCount(1,$likeUser->likedPosts);
    }

    public function test_like_comment(): void
    {
        $comment_user = User::factory()->create();

        $text = TextPost::factory()->create();
        $post = Post::factory([
            "user_id" => $comment_user->id,
            'postable_id' => $text->id,
            'postable_type' => TextPost::class
        ])->create();

        $comment = Comment::factory(["user_id" => $comment_user->id,"post_id" => $post->id])->create();

        $likeUser = User::factory()->create();

        $comment->like($likeUser);

        $this->assertCount(1,$likeUser->likedComments);
    }
}
