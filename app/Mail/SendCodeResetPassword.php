<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodeResetPassword extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {

        $name = 'BackEyes';
        $subject ='Reset Password';
        $email = 'saidoraby843@gmail.com';

        return $this->subject($subject)->from($email, $name)->
        markdown('emails.send-code-reset-password', [
            'code' => $this->code,
        ]);
    }

}
