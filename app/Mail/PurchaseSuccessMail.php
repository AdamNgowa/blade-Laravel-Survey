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

    public function build(){
        return $this
        ->subject("Your financial survey access codes")
        ->view('emails.purchase-success');
    }

    
}
