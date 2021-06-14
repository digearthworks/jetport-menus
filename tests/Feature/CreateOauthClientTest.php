<?php

namespace Tests\Feature;

use App\Auth\Models\User;
use App\Http\Livewire\OAuthClientManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Livewire;
use Tests\TestCase;

class CreateOauthClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_oauth_clients_can_be_created()
    {
        if (! Features::hasApiFeatures()) {
            return $this->markTestSkipped('API support is not enabled.');
        }

        if (Features::hasTeamFeatures()) {
            $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        } else {
            $this->actingAs($user = User::factory()->create());
        }

        Livewire::test(OAuthClientManager::class)
                    ->set(['createForm' => [
                        'name' => 'Test Client',
                        'redirect' => 'http://127.0.0.1/callback',
                        'confidential' => true,
                    ]])
                    ->call('createClient');

        $this->assertCount(1, $user->fresh()->clients);
        $this->assertEquals('Test Client', $user->fresh()->clients->first()->name);
        $this->assertFalse($user->fresh()->clients->first()->personal_access_client);
    }
}
