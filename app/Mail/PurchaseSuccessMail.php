<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase;
    public $codes;

    /**
     * Create a new message instance.
     */
    public function __construct($purchase,$codes)
    {
        $this->purchase = $purchase;
        $this->codes = $codes;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject:'Your Access Codes - Financial Survey'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.purchase-success',
            with: [
                'purchase' => $this->purchase,
                'codes' => $this->codes,
            ]
        );
    }

    

    
}
 