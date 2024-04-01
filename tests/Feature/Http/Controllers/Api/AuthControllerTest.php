<?php

namespace Feature\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserSendIncompleteInformationOnSignUp()
    {
        $payload = [ //name missing
            'email' => 'teste@teste.com',
            'password' => Hash::make('senhanexiste')
        ];

        $request = $this->post(route('auth.register'), $payload);

        $request->assertStatus(422);
        $request->assertJsonStructure(['errors']);
    }

    public function testUserSendWrongCredentialsOnLogin()
    {
        $user = User::factory()->create();
        $payload = [
            'email' => $user->email,
            'password' => 'senhanaoexiste'
        ];

        $request = $this->post(route('auth.login'), $payload);

        $request->assertStatus(401);
    }

    public function testUserCanSignIn()
    {
        $user = User::factory()->create([
            'name' => 'USER TEST',
            'email' => 'teste@teste.com',
            'password' => Hash::make(123456)
        ]);

        $payload = [
            'email' => $user->email,
            'password' => 123456
        ];

        $request = $this->post(route('auth.login'), $payload);

        $request->assertStatus(200);
        $request->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    public function testUserSignedOut()
    {
        $user = User::factory()->create([
            'name' => 'USER TEST',
            'email' => 'teste@teste.com',
            'password' => Hash::make(123456)
        ]);

        $payload = [
            'email' => $user->email,
            'password' => 123456
        ];

        $loginRequest = $this->post(route('auth.login'), $payload);
        $token = json_decode($loginRequest->getContent())->access_token;

        $logoutRequest = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->post(route('auth.logout'));
        $logoutRequest->assertStatus(200);
    }
}
