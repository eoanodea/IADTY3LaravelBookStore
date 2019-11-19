<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /** 
     * @test 
     * Testing whether the user can 
     *  see the dashboard when not logged in
     * */
    public function user_needs_to_be_logged_in_to_see_dashboard() {
        $response = $this->get('/home')->assertRedirect('/login');
    }

    /** 
     * @test 
     * Test whether a user with a user role can
     *  access the user dashboard
     * */
    public function user_with_user_role_can_access_user_dashboard() {
        $user = factory(User::class)->create();
        $user->roles()->attach(Role::where('name', 'user')->first());

        $this->actingAs($user);
        $response = $this->get('/user/home')->assertOk();
        // $response = $this->get('/home')->assertRedirect('/user/home');
    }

    /** 
     * @test 
     * Test whether a user with an admin role can
     *  access the admin dashboard
     * */
    public function user_with_admin_role_can_access_admin_dashboard() {
        $user = factory(User::class)->create();
        $user->roles()->attach(Role::where('name', 'admin')->first());

        $this->actingAs($user);
        $response = $this->get('/admin/home')->assertOk();
    }
}
