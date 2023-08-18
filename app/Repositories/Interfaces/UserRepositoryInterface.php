<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    //引数に渡されたメールアドレスを持つユーザーを取得する

    public function findFromEmail(string $email): User;

    // 引数に渡されたIDのユーザーのパスワードを更新する
    public function updateUserPassword(string $password, int $id): void;
}
