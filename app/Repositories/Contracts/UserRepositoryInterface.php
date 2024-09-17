<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByUniqueLink(string $unique_link);

    public function generateNewUniqueLink(User $user);

    public function deactivateUniqueLink(User $user);
}
