<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    public function defaultUser_IsNotAdmin()
    {
        $user = factory(User::class)->create();
        
        $this->assertFalse($user->isAdmin());
    }
    
    public function AdminUser_IsAdmin()
    {
        $admin = factory(User::class)->states('admin')->create();
        
        $this->assertTrue($admin->isAdmin());
    }
}
