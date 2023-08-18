<?php

namespace App\Rules;

use App\Repositories\Eloquents\UserTokenRepository;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;

class TokenExpirationTimeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //検証ルールに合格するかどうかを判断
    public function passes($attribute, $value)
    {
        $now = Carbon::now();
        $userTokenRepository = app()->make(UserTokenRepositoryInterface::class);
        $userToken = $userTokenRepository->getUserTokenfromToken($value);
        $expireTime = new Carbon($userToken->expire_at);

        return $now->lte($expireTime);
    }

    public function message()
    {
        return '有効期限が過ぎています。パスワードリセットメールを再発行してください。';
    }
}
