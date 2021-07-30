<?php

namespace Tests\Feature\Api;

use App\Turbine\Auth\Models\User;
use HeaderX\JetstreamPassport\Http\Livewire\OAuthClientManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Laravel\Passport\ClientRepository;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteOauthClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_oauth_clients_can_be_deleted()
    {
        if (! Features::hasApiFeatures()) {
            return $this->markTestSkipped('API support is not enabled.');
        }

        if (Features::hasTeamFeatures()) {
            $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        } else {
            $this->actingAs($user = User::factory()->create());
        }

        $clients = new ClientRepository;

        $client = $clients->create(
            $user->id,
            'Test Client',
            'https://127.0.0.1',
            null,
            false,
            false,
            true
        );

        Livewire::test(OAuthClientManager::class)
                    ->set(['clientIdBeingDeleted' => $client->id])
                    ->call('deleteClient');

        $this->assertCount(0, $clients->activeForUser($user->id));
    }
}
