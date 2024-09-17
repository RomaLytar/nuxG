<?
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;

class LuckyGameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_plays_the_lucky_game_and_calculates_win_amount()
    {
        $user = User::factory()->create([
            'unique_link' => 'testlink123',
            'link_expires_at' => now()->addDays(7),
        ]);

        $this->partialMock(UserService::class, function ($mock) {
            $mock->shouldReceive('generateRandomNumber')
                ->andReturn(950);
        });

        $response = $this->post(route('pageA.lucky', $user->unique_link));

        $response->assertSessionHas('randomNumber', 950);
        $response->assertSessionHas('isWin', 'Win');
        $response->assertSessionHas('winAmount', 950 * 0.7); // 70% от 950
    }
}
