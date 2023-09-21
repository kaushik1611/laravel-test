<?php

namespace App\Mail;

use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductCancelled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(protected Customer $user, protected Subscription $activeSubscription)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Product Cancelled',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $message = $this->activeSubscription->name == 'b2b product' ? 'B2B Customer' : 'B2C Customer';
        return new Content(
            markdown: 'emails.products.cancelled',
            with: [
                'user' => $this->user,
                'message' => $message
            ]
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
