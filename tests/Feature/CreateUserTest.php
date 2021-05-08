<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_users_page()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/users');

        $response->assertOk();
    }
}
