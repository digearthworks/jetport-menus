<?php

namespace Tests\Feature\Api;

use HeaderX\JetstreamPassport\Http\Livewire\ApiTokenManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Jetstream\Features;
use Livewire\Livewire;
use Tests\TestCase;
use Turbine\Auth\Models\User;

class ApiTokenPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_token_permissions_can_be_updated()
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
                    ->set(['managingPermissionsForId' => $token->id])
                    ->set(['updateApiTokenForm' => [
                        'scopes' => [
                            'delete',
                            'missing-permission',
                        ],
                    ]])
                    ->call('updateApiToken');

        $this->assertTrue($user->fresh()->tokens->first()->can('delete'));
        $this->assertFalse($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('missing-permission'));
    }
}
