<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
//    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData, $link)
    {
        $this->mailData = $mailData;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = [
            'title' => 'Invitation from ' . env('MAIL_USERNAME'),
            'body' => 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . $this->link
        ];
        $pdf = PDF::loadView('email.inviteMail', ['mailData' => $mailData]);
        return $this->subject($this->mailData['subject'])
            ->view('email.inviteMail')
            ->attachData($pdf->output(), "invitation.pdf");
    }
}
