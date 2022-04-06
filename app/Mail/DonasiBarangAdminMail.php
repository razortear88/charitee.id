<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonasiBarangAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail_donasi_barang;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail_donasi_barang)
    {
        $this->detail_donasi_barang = $detail_donasi_barang;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Donasi Barang Baru [ID:".$this->detail_donasi_barang['id_donasi']."]")->markdown('mail.donasi_barang_mail');
    }
}
