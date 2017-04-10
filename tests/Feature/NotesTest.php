<?php

namespace Tests\Endpoints;

use App\Models\Note;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class NotesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGettingAllNotes()
    {
        // without authentication should give 401
        $response = $this->call('GET', 'api/notes');
        $response->assertStatus(401);

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $response = $this->call('GET', 'api/notes');
        $response->assertStatus(200);
    }

    public function testGettingSpecificNote()
    {
        // without authentication should give 401
        $response = $this->call('GET', 'api/notes/12345');
        $response->assertStatus(401);

        $note = factory(Note::class)->create();

        $user = factory(User::class)->create(['role' => User::ADMIN_ROLE]);
        $this->actingAs($user, 'api');

        // should work
        $response = $this->call('GET', 'api/notes/'.$note->uid);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'message' => $note->message
                ]
            ]);

        // accessing invalid note should give 404
        $response = $this->call('GET', 'api/notes/13232323');
        $response->assertStatus(404);
    }

    public function testCreatingNote()
    {
        // without authentication should give 401 Unauthorized
        $response = $this->call('POST', 'api/notes', []);
        $response->assertStatus(401);

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        // empty data should give 400 invalid fields error
        $response = $this->call('POST', 'api/notes', []);
        $response->assertStatus(400);

        // should work now
        $response = $this->call('POST', 'api/notes', [
            'message'   => 'php is awesome',
            'tags'      => 'php',
            'userId'    => $user->id
        ]);
        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'message' => 'php is awesome'
                ]
            ]);
    }

    public function testUpdatingNote()
    {
        $note = factory(Note::class)->create();

        // without authentication should give 401 Unauthorized
        $response = $this->call('PUT', 'api/notes/'.$note->uid, []);
        $response->assertStatus(401);

        $user = factory(User::class)->create(['role' => User::ADMIN_ROLE]);
        $this->actingAs($user, 'api');

        $response = $this->call('PUT', 'api/notes/'.$note->uid, [
            'message' => 'notes message updated'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'message' => 'notes message updated'
                ]
            ]);

        $response = $this->call('PUT', 'api/notes/234324', [
            'message' => 'updated'
        ]);
        $response->assertStatus(404);
    }

    public function testDeletingNote()
    {
        // without authentication should give 401
        $response = $this->call('DELETE', 'api/notes/12345');
        $response->assertStatus(401);

        $note = factory(Note::class)->create();

        $user = factory(User::class)->create(['role' => User::ADMIN_ROLE]);
        $this->actingAs($user, 'api');

        // should work
        $response = $this->call('DELETE', 'api/notes/'.$note->uid);
        $response->assertStatus(204);

        // deleting invalid note should give 404
        $response = $this->call('GET', 'api/notes/13232323');
        $response->assertStatus(404);
    }
}