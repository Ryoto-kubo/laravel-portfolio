<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function testIsFollowedByNull()
    {
        $user = factory(User::class)->create();
        $result = $user->isFollowedBy(null);
        $this->assertFalse($result);
    }

    public function testIsFollowedTheUser()
    {
        $user = factory(User::class)->create();
        $user_second = factory(User::class)->create();
        $user->followings()->attach($user_second);

        $result = $user->isFollowedBy($user_second);
        $this->assertFalse($result);
    }
}
