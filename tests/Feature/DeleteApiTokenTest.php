<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Jetstream\Features;
use App\Http\Livewire\ApiTokenManagerComponent;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_tokens_can_be_deleted()
    {
        Artisan::call('passport:client', ['--personal' => true, '--name' => 'Laravel Personal Access Client']);

        if (! Features::hasApiFeatures()) {
            return $this->markTestSkipped('API support is not enabled.');
        }

        if (Features::hasTeamFeatures()) {
            $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        } else {
            $this->actingAs($user = User::factory()->create());
        }

        $token = $user->createToken('Test Token', ['create', 'read'])->token;

        Livewire::test(ApiTokenManagerComponent::class)
                    ->set(['apiTokenIdBeingDeleted' => $token->id])
                    ->call('deleteApiToken');

        $this->assertCount(0, $user->fresh()->tokens);
    }
}
