<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Search user fot uniq link
     * @param string $unique_link
     * @return User|null
     */
    public function findByUniqueLink(string $unique_link): ?User
    {
        return User::where('unique_link', $unique_link)
            ->where('link_expires_at', '>=', now())
            ->first();
    }

    /**
     * General new uniq link
     * @param User $user
     * @return string
     */
    public function generateNewUniqueLink(User $user): string
    {
        $user->unique_link = \Str::random(32);
        $user->link_expires_at = now()->addDays(7);
        $user->save();
        return $user->unique_link;
    }

    /**
     * Deactivated uniq link
     * @param User $user
     * @return void
     */
    public function deactivateUniqueLink(User $user): void
    {
        $user->link_expires_at = now();
        $user->save();
    }
}
