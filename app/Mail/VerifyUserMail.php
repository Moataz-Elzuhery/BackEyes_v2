<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Setting;

class VerifyUserMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $user;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $email = 'saidoraby843@gmail.com';

        $name = 'BackEyes';

        $subject = 'verify Email';

        return $this->to($this->user)->subject($subject)->from($email, $name)->
        markdown('emails.verifyUser', [
            'user' => $this->user,
            'code' => $this->code
        ]);


    }


}
