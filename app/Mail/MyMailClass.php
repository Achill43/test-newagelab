<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyMailClass extends Mailable
{
    protected $theme;
    protected $userName;
    protected $userEmail;
    protected $organization;
    protected $message;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($theme, $userName, $userEmail, $organization, $message)
    {
        $this->theme=$theme;
        $this->userName=$userName;
        $this->userEmail=$userEmail;
        $this->organization=$organization;
        $this->message=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('message')->with([
            'theme'=>$this->theme,
            'userName'=>$this->userName,
            'userEmail'=>$this->userEmail,
            'organization'=>$this->organization,
            'message'=>$this->message,
        ])->subject('Hoвое сообщение');
    }
}
