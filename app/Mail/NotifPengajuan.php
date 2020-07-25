<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifPengajuan extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pengajuan)
    {
        $this->data['user'] = $user;
        $this->data['pengajuan'] = $pengajuan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown( 'emails.sendNotifPengajuan' )
        ->subject( '[' . config('app.name') . '] Notifikasi Pengajuan Jadwal' )
        ->with( $this->data );
    }
}
