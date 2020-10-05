<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;


class ApiVerificationEmail extends VerifyEmailBase
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute('api.verification.verify',
            Carbon::now()->addMinutes(60), 
            ['id' => $notifiable->getKey()]
        );
    }
}
