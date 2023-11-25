<?php

namespace Tests\Feature;

use App\Models\UserGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Profile;
use App\Models\User;
use App\Models\Post;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_profile() {
        $user = User::factory()->create();
        $profile = Profile::factory(["user_id" => $user->id])->create();
        
        $this->assertEquals(1,User::count());
        $this->assertEquals(1,Profile::count());
        
        $this->assertEquals($user->profile->firstName,$profile->firstName);
        $this->assertEquals($user->id,$profile->user->id);
    }

    public function test_user_group() {

        $group = UserGroup::factory()->create();
        $user = User::factory(["user_group_id" => $group->id])->create();
        $profile = Profile::factory(["user_id" => $user->id])->create();
        $post = Post::factory(["user_id" => $user->id])->create();
        
        $this->assertCount(1, $group->posts);

        
        
    }
}
