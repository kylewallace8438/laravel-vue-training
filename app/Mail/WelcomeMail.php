<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $user;
    public $carts;
    public $check;
    public function __construct($user, $carts, $check)
    {
        $this->user = $user;
        $this->carts = $carts;
        $this->check = $check;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject:'Welcome Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view:'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
    public function build()
    {
        if ($this->check == 1) {
            return $this->view('emails.welcome')->with([
                'user' => $this->user,
                'carts' => $this->carts,
            ]);
        } else {
            return $this->view('emails.thankOrder')->with([
                'user' => $this->user,
            ]);
        }

    }
}
