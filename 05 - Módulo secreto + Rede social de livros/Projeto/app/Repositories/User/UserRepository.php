<?php

namespace App\Repositories\User;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): bool
    {
        $user = new User();

        $user->name = $data[User::NAME];
        $user->email = $data[User::EMAIL];
        $user->username = $data[User::USERNAME];
        $user->password = bcrypt($data[User::PASSWORD]);

        return $user->save();
    }

    public function find(int $id): object
    {
        return User::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $user = User::find($id);

        return $user->update($data);
    }
}
