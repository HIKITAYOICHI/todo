<?php

namespace Tests\Feature;

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
    public function testget()
    {
        $response = $this->get('/');
        $response = $this->get('user/login');
        $response = $this->get('user/register');
        
        $response->assertStatus(200);
    }
    
    public function testget2()
    {
        $response = $this->get('user/tasks');
        $response = $this->get('user/tasks/create');
        $response = $this->get('user/tasks/edit');
        $response = $this->get('user/tasks/delete');
        $response = $this->get('admin/tasks');
        $response = $this->get('admin/tasks/create');
        $response = $this->get('admin/tasks/edit');
        $response = $this->get('admin/tasks/delete');
        $response = $this->get('admin/login');
        $response = $this->get('admin/register');


        $response->assertStatus(302);
    }
    
    

}
