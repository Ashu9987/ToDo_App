<?php

namespace App\Repositories\Interfaces;

use App\Models\UserToken;

interface UserTokenRepositoryInterface
{

    //Userのパスワードリセット用のトークンを発行する
    //すでに存在していれば更新する
    public function updateOrCreateUserToken(int $userId): UserToken;

    // トークンからUserTokenのレコードを１件取得
    public function getUserTokenfromToken(string $token): UserToken;
}
