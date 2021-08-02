<?php

namespace Tests\Feature\Api;

use App\Turbine\Auth\Models\User;
use HeaderX\JetstreamPassport\Http\Livewire\ApiTokenManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Jetstream\Features;
use Livewire\Livewire;
use Tests\TestCase;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_tokens_can_be_created()
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

        Livewire::test(ApiTokenManager::class)
                    ->set(['createApiTokenForm' => [
                        'name' => 'Test Token',
                        'scopes' => [
                            'read',
                            'update',
                        ],
                    ]])
                    ->call('createApiToken');

        $this->assertCount(1, $user->fresh()->tokens);
        $this->assertEquals('Test Token', $user->fresh()->tokens->first()->name);
        $this->assertTrue($user->fresh()->tokens->first()->can('read'));
        $this->assertFalse($user->fresh()->tokens->first()->can('delete'));
    }
}
