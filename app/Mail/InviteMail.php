<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData = ['title' => 'Урилга'];
    public $user;
    public $link;
//    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdfData = [
            'title' => $this->mailData['title'],
            'body' => 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . $this->link
        ];
        $pdf = PDF::loadView('email.invitePdf', ['mailData' => $pdfData]);
        $this->mailData['image_url'] = $pdfData['body'];
        $this->mailData['image_src'] = base64_encode(file_get_contents($pdfData['body']));
        return $this->subject($this->mailData['title'])
            ->view('email.inviteMail', ['mailData', $this->mailData])
            ->attachData($pdf->output(), "invitation.pdf");
    }
}
