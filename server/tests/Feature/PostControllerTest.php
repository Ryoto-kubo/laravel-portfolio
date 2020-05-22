<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('post.index'));

        $response->assertStatus(302);
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('post.create'));
        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('post.create'));
        $response->assertStatus(200)->assertViewIs('posts.create');
    }
}
