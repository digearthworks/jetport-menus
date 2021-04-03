<?php

namespace Database\Seeders\Examples;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Laravel\Passport\Client;

class ClientSeederExample extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::withoutEvents(function(){
            return Client::create([
                'id' => '12345678-9abc-defg-hijk-lmnopqrstuvw',
                'user_id' => 1,
                'name' => 'Example',
                'secret' => 'examplsecretchangemenow!',
                'provider' => null,
                'redirect' => config('examples.clients.redirect'),
                'personal_access_client' => false,
                'password_client' => false,
                'revoked' => false,
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ]);
        });
    }
}
