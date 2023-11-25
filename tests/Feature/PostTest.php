<?php

namespace Tests\Feature;

use App\Models\TextPost;
use App\Models\VideoPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory(["user_id" => $user->id])->create();
        Post::factory(["user_id" => $user->id])->create();
        $this->assertEquals(2,$user->posts->count());
        $this->assertEquals($post->user->id,$user->id);

    }

    public function test_create_post_tag(): void
    {
        $user = User::factory()->create();
        $post = Post::factory(["user_id" => $user->id])->create();
        $tag1 = Tag::factory()->create();
        $tag2 = Tag::factory()->create();
        $post->tags()->attach($tag1);
        $post->tags()->attach($tag2);
        $this->assertEquals(2,$post->tags->count());

        $tagData = Tag::first();
        $this->assertEquals($tagData->posts->first()->id,$post->id);
    }
    
    public function test_video_post(): void
    {
        $user = User::factory()->create();
        $video = VideoPost::factory()->create();
        $post = Post::factory([
            "user_id" => $video->id,
            'postable_id' => $video->id,
            'postable_type' => VideoPost::class
        ])->create();
      
        $videoPost = $post->postable;
        $this->assertEquals($videoPost->id,$video->id);
        $this->assertEquals($videoPost->post->id,$post->id);
    }

    public function test_text_post(): void
    {
        $user = User::factory()->create();

        $text = TextPost::factory()->create();
        $post = Post::factory([
            "user_id" => $user->id,
            'postable_id' => $text->id,
            'postable_type' => TextPost::class
        ])->create();
        
        $textPost = $post->postable;
        $this->assertEquals($textPost->id,$text->id);
        $this->assertEquals($textPost->post->id,$post->id);
    }
}
