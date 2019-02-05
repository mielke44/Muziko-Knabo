<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionMails extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $receiver;
    public $text;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$receiver)
    {
        $this->data = $data;
        $this->receiver = $receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreplyservice@soirmusic.com','You got Mail from Soir music!')
                    ->to($this->receiver)
                    ->cc('wilson.mielke@gmail.com')
                    ->subject('Soir Music Question')
                    ->view('question_mail')->with(['data'=> $this->data]);
    }
}
