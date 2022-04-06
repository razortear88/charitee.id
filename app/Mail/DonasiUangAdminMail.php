<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonasiUangAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail_donasi_uang;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail_donasi_uang)
    {
        $this->detail_donasi_uang = $detail_donasi_uang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Donasi Uang Baru [ID:".$this->detail_donasi_uang['id_donasi']."]")->markdown('mail.donasi_uang_admin_mail');
    }
}
