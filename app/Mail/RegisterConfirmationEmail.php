<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_confirm;

    /**
     * Create a new message instance.
     */
    public function __construct($user_confirm)
    {
        $this->user_confirm = $user_confirm;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de correo SPS',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())
            ->with([
                'name' => $this->user_confirm['name'],
                'email' => $this->user_confirm['email'],
                'confirm_code' => $this->user_confirm['confirmation_code']
            ]) -> view('emails.confirmacionRegistrar');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            
        ];
    }
}
