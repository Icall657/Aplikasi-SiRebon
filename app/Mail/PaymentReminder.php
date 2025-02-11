<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $kapal;
    public $dueDate;

    /**
     * Create a new message instance.
     */
    public function __construct($nama, $kapal, $dueDate)
    {
        $this->nama = $nama;
        $this->kapal = $kapal;
        $this->dueDate = $dueDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengingat Pembayaran Retribusi',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_reminder',
        );
    }
}
