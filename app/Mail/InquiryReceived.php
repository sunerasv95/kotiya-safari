<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;

class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        
    }

    public function build()
    {
        return $this->view('emails.inquiries.acknowledge');
    }
}
