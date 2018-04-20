<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function CantAcces_AdminSection()
    {
        $user = factory(User::class)->create();
        
        $this->actingAs($user)->get('/admin')->assertRedirect('home');
    }
    
    public function AdminCanAccess_AdminSection()
    {
        $admin = factory(User::class)->states('admin')->create();
        
        $this->actingAs($admin)->get('/admin')->assertStatus(200);
    }
}
