<?php

namespace App\Services;

use App\Models\GameHistory;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Facades\ModelSaverFacade as ModelSaver;

class UserService
{
    const WIN = 'Win';
    const LOSE = 'Lose';
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // get user sot uniq link
    public function getUserByUniqueLink($unique_link)
    {
        return $this->userRepository->findByUniqueLink($unique_link);
    }

    // generate uniq link
    public function generateNewLink($unique_link)
    {
        $user = $this->getUserByUniqueLink($unique_link);
        if ($user) {
            return $this->userRepository->generateNewUniqueLink($user);
        }
        return null;
    }

    // deactivated uniq link
    public function deactivateLink($unique_link)
    {
        $user = $this->getUserByUniqueLink($unique_link);
        if ($user) {
            $this->userRepository->deactivateUniqueLink($user);
        }
    }

    // Game Im Feeling Lucky
    public function playLuckyGame($unique_link)
    {
        $user = $this->getUserByUniqueLink($unique_link);

        if (!$user) {
            return ['error' => 'The link is invalid or expired.'];
        }

        $randomNumber = $this->generateRandomNumber();
        $isWin = $randomNumber % 2 === 0 ? self::WIN : self::LOSE;
        $winAmount = 0;

        if ($isWin === self::WIN) {
            $winAmount = $this->calculateWinAmount($randomNumber);
        }
        $data = [
            'user_id' => $user->id,
            'random_number' => $randomNumber,
            'result' => $isWin,
            'win_amount' => $winAmount,
        ];

        ModelSaver::save(new GameHistory(), $data);

        return $data;
    }
    private function generateRandomNumber(): int
    {
        return rand(1, 1000);
    }

    /**
     * Calculating winning amount
     * @param int $randomNumber
     * @return float
     */
    private function calculateWinAmount(int $randomNumber): float
    {
        if ($randomNumber > 900) {
            return $randomNumber * 0.7;
        } elseif ($randomNumber > 600) {
            return $randomNumber * 0.5;
        } elseif ($randomNumber >= 300) {
            return $randomNumber * 0.3;
        } else {
            return $randomNumber * 0.1;
        }
    }
}
