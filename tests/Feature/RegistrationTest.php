<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_user_and_generates_unique_link()
    {
        $response = $this->post('/register', [
            'username' => 'testuser',
            'phonenumber' => '1234567890',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'testuser',
            'phonenumber' => '1234567890',
        ]);

        $user = User::where('phonenumber', '1234567890')->first();
        $this->assertNotNull($user->unique_link);
        $this->assertTrue(Carbon::now()->lessThan($user->link_expires_at)); // проверка срока ссылки

        $response->assertSessionHas('link', route('pageA', $user->unique_link));
    }
}
