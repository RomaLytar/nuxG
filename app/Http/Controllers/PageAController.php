<?php

namespace App\Http\Controllers;

use App\Models\GameHistory;
use App\Services\UserService;

class PageAController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(string $unique_link)
    {
        $user = $this->userService->getUserByUniqueLink($unique_link);

        if (!$user) {
            return redirect('/')->with('error', 'The link is invalid or expired.');
        }

        return view('pageA', compact('user'));
    }

    public function generateNewLink(string $unique_link)
    {
        $newLink = $this->userService->generateNewLink($unique_link);

        if ($newLink) {
            return redirect()->route('pageA', ['unique_link' => $newLink]);
        }

        return redirect()->back()->with('error', 'Error generating new link.');
    }
    public function deactivateLink(string $unique_link)
    {
        $this->userService->deactivateLink($unique_link);
        return redirect('/')->with('message', 'The link has been successfully deactivated.');
    }

    public function feelingLucky($unique_link)
    {
        $result = $this->userService->playLuckyGame($unique_link);

        if (isset($result['error'])) {
            return redirect('/')->with('error', $result['error']);
        }

        return redirect()->back()->with([
            'randomNumber' => $result['random_number'],
            'isWin' => $result['result'],
            'winAmount' => $result['win_amount'],
        ]);
    }

    public function history($unique_link)
    {
        $user = $this->userService->getUserByUniqueLink($unique_link);

        if (!$user) {
            return redirect('/')->with('error', 'The link is invalid or expired.');
        }

        // History game user, last GameHistory::COUNT_HISTORY
        $history = GameHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(GameHistory::COUNT_HISTORY)
            ->get();

        return view('history', compact('history'));
    }
}

