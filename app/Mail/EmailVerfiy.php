<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailVerfiy extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $email;
    /**
     * Create a new message instance.
     *
     * @param  array  $mailData
     * @param  string $imagePath
     * @param  string $pdfPath
     * @return void
     */
    public function __construct($mailData, $email)
    {
        $this->mailData = $mailData;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.otpmail')
            ->subject('Amalorpavam Alumini - OTP Verification');
    }

}
