<?php

namespace Tests\Endpoints;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    public function testGettingAllUsers()
    {
        // without authentication should give 401
        $response = $this->call('GET', 'api/users');
        $response->assertStatus(401);

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $response = $this->call('GET', 'api/users');
        $response->assertStatus(200);
    }

    public function testGettingSpecificUser()
    {
        // without authentication should give 401
        $response = $this->call('GET', 'api/users/12345');
        $response->assertStatus(401);

        $user = factory(User::class)->create();

        // authenticate
        $this->actingAs($user, 'api');

        // should work
        $response = $this->call('GET', 'api/users/'.$user->uid);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'email' => $user->email
                ]
            ]);

        // accessing invalid user should give 404
        $response = $this->call('GET', 'api/users/13232323');
        $response->assertStatus(404);
    }

    public function testCreatingUser()
    {
        // without authentication should give 401 Unauthorized
        $response = $this->call('POST', 'api/users', []);
        $response->assertStatus(401);

        $user = factory(User::class)->make();
        $this->actingAs($user);

        // empty data should give 400 invalid fields error
        $response = $this->call('POST', 'api/users', []);
        $response->assertStatus(400);

        // should work now
        $response = $this->call('POST', 'api/users', [
            'email'     => 'test@test.com',
            'firstName' => 'first',
            'lastName'  => 'last',
            'password'  => bcrypt('secret')
        ]);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'email' => 'test@test.com'
                ]
            ]);

        // same email should give 400 invalid
        $response = $this->call('POST', 'api/users', [
            'email'     => 'test@test.com',
            'firstName' => 'first2',
            'lastName'  => 'last2',
            'password'  => bcrypt('secret')
        ]);
        $response->assertStatus(400);
    }

    public function testUpdatingUser()
    {
        $user = factory(User::class)->create();

        // without authentication should give 401 Unauthorized
        $response = $this->call('PUT', 'api/users/'.$user->uid, []);
        $response->assertStatus(401);

        // authenticate
        $this->actingAs($user);

        $response = $this->call('PUT', 'api/users/'.$user->uid, [
            'firstName' => 'updated_first'
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'firstName' => 'updated_first'
                ]
            ]);

        $response = $this->call('PUT', 'api/users/234324', [
            'firstName' => 'updated_first'
        ]);
        $response->assertStatus(404);
    }

    public function testDeletingUser()
    {
        // without authentication should give 401
        $response = $this->call('DELETE', 'api/users/12345');
        $response->assertStatus(401);

        $user = factory(User::class)->create();

        // authenticate
        $this->actingAs($user);

        // should work
        $response = $this->call('DELETE', 'api/users/'.$user->uid);
        $response->assertStatus(204);

        // deleting invalid user should give 404
        $response = $this->call('GET', 'api/users/13232323');
        $response->assertStatus(404);
    }
}