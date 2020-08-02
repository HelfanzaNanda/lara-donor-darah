<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifTidakLayakDonor extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $cek)
    {
        $this->data['user'] = $user;
        $this->data['cek'] = $cek;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown( 'emails.sendNotifTidakLayakDonor' )
        ->subject( '[' . config('app.name') . '] Notifikasi Donor Darah' )
        ->with( $this->data );
    }
}
