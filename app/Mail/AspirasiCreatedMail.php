<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\aspirasi;

class AspirasiCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $aspirasi;
    public $student;
    public $category;

    /**
     * Create a new message instance.
     */
    public function __construct(aspirasi $aspirasi)
    {
        $this->aspirasi = $aspirasi;
        $this->student = $aspirasi->user;
        $this->category = $aspirasi->kategori;
    }

    /**
     * Email subject
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Aspirasi Baru: ' . $this->aspirasi->feedback_title
        );
    }

    /**
     * Email view
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.aspiration_created',
            with: [
                'aspirasi' => $this->aspirasi,
                'student' => $this->student,
                'category' => $this->category,
            ],
        );
    }

    /**
     * Attachments
     */
    public function attachments(): array
    {
        return [];
    }
}
