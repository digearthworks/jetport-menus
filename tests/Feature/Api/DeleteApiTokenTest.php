<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Jetstream\Features;
use Livewire\Livewire;
use HeaderX\JetstreamPassport\Http\Livewire\ApiTokenManager;
use Tests\TestCase;
use Turbine\Auth\Models\User;

class DeleteApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_tokens_can_be_deleted()
    {
        if (! Features::hasApiFeatures()) {
            return $this->markTestSkipped('API support is not enabled.');
        }

        Artisan::call('passport:client', ['--personal' => true, '--name' => 'Laravel Personal Access Client']);

        if (Features::hasTeamFeatures()) {
            $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        } else {
            $this->actingAs($user = User::factory()->create());
        }

        $token = $user->createToken('Test Token', ['create', 'read'])->token;

        Livewire::test(ApiTokenManager::class)
                    ->set(['apiTokenIdBeingDeleted' => $token->id])
                    ->call('deleteApiToken');

        $this->assertCount(0, $user->fresh()->tokens);
    }
}
