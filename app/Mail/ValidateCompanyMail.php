<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class ValidateCompanyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('validate company')
            ->markdown('validateCompanyEmail');
    }
}
