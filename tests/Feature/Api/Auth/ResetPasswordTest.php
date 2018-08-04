<?php

namespace Tests\Feature\Api\Auth;


use Hedonist\Entities\User;
use Hedonist\Events\Auth\PasswordResetedEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    public function test_reset_password()
    {
        Event::fake();

        $user = factory(User::class)->create();
        $response = $this->json('POST', '/api/v1/auth/recover', ['email' => $user->email]);
        Event::assertDispatched(PasswordResetedEvent::class,function($e){
            $this->token = $e->getToken();
            return true;
        });
        $this->assertDatabaseHas('password_resets',['email' => $user->email]);
        $response->assertStatus(200);
        $response = $this->json('POST','/api/v1/auth/reset',[
            'email' => $user->email,
            'token' => $this->token,
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        Log::debug($response->json());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }
}