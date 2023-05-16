<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;
    

    public $user;
    public $viewname;
    public $sub;
    public $messages;
    /**
     * Create a new message instance.
     * @param User $user
     * @return void
     */
    public function __construct($user, $viewname, $sub, $messages)
    {
       $this->user = $user;
       $this->viewname = $viewname;
       $this->sub = $sub;
       $this->messages = $messages;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@yamaitre.com','Yamaitre')
                    ->subject($this->sub)
                    ->view($this->viewname)
                    ->with([
                        'name' => $this->user->first_name,
                        'msg' => $this->messages
                    ]);
                
    }
}
