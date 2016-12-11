<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendImageUrl extends Mailable
{
    use Queueable, SerializesModels;
    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        //
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'name' =>  $this->request->name,
            'url'  =>  $this->request->url
        ];
        return $this->view('email.sendImageUrl')
            ->with($data)
            ->from('support@backbone.com', 'BackBone Support')
            ->replyTo('support@backbone.com', 'BackBone Support')
            ->subject('Enrollee Image Upload');
    }
}
