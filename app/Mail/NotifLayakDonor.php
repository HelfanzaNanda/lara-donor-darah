<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifLayakDonor extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pendonor)
    {
        $this->data['user'] = $user;
        $this->data['pendonor'] = $pendonor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown( 'emails.sendNotifLayakDonor' )
        ->subject( '[' . config('app.name') . '] Notifikasi Donor Darah' )
        ->with( $this->data );
    }
}
