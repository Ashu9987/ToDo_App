<?php

namespace App\Mail;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

// class ResetPassword extends Mailable
// {
//     use Queueable, SerializesModels;

//     private $token;

//     /**
//      * Create a new message instance.
//      *
//      * @param $token
//      */
//     public function __construct($token)
//     {
//         $this->token = $token;
//     }

//     /**
//      * Build the message.
//      *
//      * @return $this
//      */
//     public function build()
//     {
//         return $this
//             ->subject('パスワード再設定')
//             ->view('mail.password-reset');
//     }
// }

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\UserToken;
use App\Models\User;
use Carbon\Carbon;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;

    public function __construct(
        User $user,
        UserToken $userToken
    ) {
        $this->user = $user;
        $this->userToken = $userToken;
    }

    public function build()
    {
        $tokenParam = ['reset_token' => $this->userToken->token];
        $now = Carbon::now();

        $url = URL::temporarySignedRoute('edit', $now->addHours(24), $tokenParam);

        return $this->to($this->user->email)
            ->subject('パスワード再設定')
            ->view('mail.password-reset')
            ->with([
                'user' => $this->user,
                'url' => $url,
            ]);
    }
}
