<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class AuthenticationTest extends DuskTestCase
{
    use DatabaseTransactions;
    /**
     * Teste para verificar se um usuário pode se autenticar corretamente.
     *
     * @return void
     */
    public function testUserAuthentication()
    {


        $user = User::factory()->create([
            'email' => 'user2@example.com',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->waitFor('email') // Espera até que o campo de e-mail esteja visível
                ->type('email', $user->email) // Usando XPath para localizar o campo de e-mail
                ->type('password', 'password123')
                ->press('Log in')
                ->assertPathIs('/dashboard')
                ->assertAuthenticated();
        });
    }
}
