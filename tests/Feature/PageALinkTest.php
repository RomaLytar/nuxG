<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class PageALinkTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_a_new_unique_link()
    {
        $user = User::factory()->create([
            'unique_link' => 'oldlink123',
            'link_expires_at' => now()->addDays(7),
        ]);

         $this->post(route('pageA.generate', $user->unique_link));

        $user->refresh();

        $this->assertNotEquals('oldlink123', $user->unique_link);

        $this->assertTrue(now()->lessThan($user->link_expires_at));
    }
}
