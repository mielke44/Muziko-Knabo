<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AttachedMail extends Mailable
{
    use Queueable, SerializesModels;
    

    /**
     * The demo object instance.
     *
     * @var Data
     */
    public $data;
    public $fileName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$fileName)
    {
        $this->data= $data;
        $this->fileName= $fileName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreplyservice@soirmusic.com','You got Mail from Soir music!')
                    //->to('contact.brunorios@gmail.com');
                    ->to('wilson.mielke@gmail.com')
                    ->subject('Soir Music Request')
                    ->view('mail',['data'=> $this->data])
                    ->attachFromStorage('storage/app/', $this->fileName);
    }
}