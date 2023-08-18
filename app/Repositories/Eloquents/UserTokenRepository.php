<?php

namespace App\Repositories\Eloquents;

use App\Models\UserToken;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use Carbon\Carbon;



class UserTokenRepository implements UserTokenRepositoryInterface
{
    private $userToken;

    public function __construct(UserToken $userToken)
    {
        $this->userToken = $userToken;
    }

    public function updateOrCreateUserToken(int $userId): UserToken
    {
        $now = Carbon::now();
        $hashedToken = hash('sha256', $userId);
        return $this->userToken->updateOrCreate(
            [
                'user_id' => $userId,
            ],
            [
                'token' => uniqid(rand(), $hashedToken), //正在创建一个令牌，其中包含一个用 散列的$userId字符串
                'expire_at' => $now->addHours(48)->toDateTimeString(), //令牌将在 48 小时后过期。
            ]
        );
    }

    public function getUserTokenfromToken(string $token): UserToken
    {
        return $this->userToken->where('token', $token)->firstOrFail();
    }
}
