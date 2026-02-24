<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AspirasiRespondedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aspirasi;
    public $student;

    /**
     * Create a new message instance.
     */
    public function __construct($aspirasi)
    {
        $this->aspirasi = $aspirasi;
        $this->student = $aspirasi->user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Balasan Aspirasi: ' . $this->aspirasi->feedback_title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.aspiration_responded',
            with: [
                'aspirasi' => $this->aspirasi,
                'student' => $this->student,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
