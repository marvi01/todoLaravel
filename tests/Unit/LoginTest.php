<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_user_cannot_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $response = $this->post('/', [
            'email' => $user->email,
            'password' =>  '123mudar',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
