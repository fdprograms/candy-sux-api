<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Laravel\Passport\Passport;
use Str;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * test_save.
     *
     * @return void
     */
    public function test_save()
    {
        $user = User::where('email', config('app.support_email'))->first();
        Passport::actingAs($user);
        $data = [
            'user' => User::factory()->make()->toArray(),
            'company' => Company::factory()->make()->toArray()
        ];
        $data['user']['password'] = Str::random(10);
        $response = $this->actingAs($user)->withHeaders([
            'Authorization' => 'Bearer ' . $user->generateToken()
        ])->postJson(
            '/api/admin/users',
            $data
        );

        $response->assertStatus(201);
    }
}
