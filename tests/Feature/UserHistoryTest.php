<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\GameHistory;

class UserHistoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    /** @test */
    public function it_displays_the_last_3_game_results()
    {
        // Создаем пользователя
        $user = User::factory()->create([
            'unique_link' => 'testlink123',
            'link_expires_at' => now()->addDays(7),
        ]);

        // Создаем 3 записи истории игр для пользователя
        GameHistory::factory()->create([
            'user_id' => $user->id,
            'random_number' => 123,
            'result' => 'Lose',
            'win_amount' => 0,
        ]);

        GameHistory::factory()->create([
            'user_id' => $user->id,
            'random_number' => 456,
            'result' => 'Win',
            'win_amount' => 45.6,
        ]);

        GameHistory::factory()->create([
            'user_id' => $user->id,
            'random_number' => 789,
            'result' => 'Win',
            'win_amount' => 236.7,
        ]);

        // Отправляем запрос на просмотр истории
        $response = $this->post(route('pageA.history', $user->unique_link));

        // Проверяем, что последние 3 результата отображаются на странице
        $response->assertStatus(200);
        $response->assertSeeText('Number: 123');
        $response->assertSeeText('Result: Lose');
        $response->assertSeeText('Win: 0');

        $response->assertSeeText('Number: 456');
        $response->assertSeeText('Result: Win');
        $response->assertSeeText('Win: 45.6');

        $response->assertSeeText('Number: 789');
        $response->assertSeeText('Result: Win');
        $response->assertSeeText('Win: 236.7');
    }

    /** @test */
    public function it_displays_message_if_no_game_history()
    {
        $user = User::factory()->create([
            'unique_link' => 'testlink123',
            'link_expires_at' => now()->addDays(7),
        ]);

        $response = $this->post(route('pageA.history', $user->unique_link));

        $response->assertStatus(200);
        $response->assertSeeText('History is empty.');
    }
}
