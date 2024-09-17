<?php
namespace Database\Factories;

use App\Models\GameHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameHistoryFactory extends Factory
{
    protected $model = GameHistory::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'random_number' => $this->faker->numberBetween(1, 1000),
            'result' => $this->faker->randomElement(['Win', 'Lose']),
            'win_amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
