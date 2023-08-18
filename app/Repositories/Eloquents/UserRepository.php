<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    //findFromEmail该函数返回一个将电子邮件地址作为参数传递User的实例
    public function findFromEmail(string $email): User
    {
        return $this->user->where('email', $email)->firstOrFail();
    }

    public function updateUserPassword(string $password, int $id): void
    {
        $this->user->where('id', $id)->update(['password' => Hash::make($password)]);
    }
}
