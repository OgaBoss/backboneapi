<?php

namespace App\Http\Controllers;

use App\Mail\SendImageUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function mailParams(){
        Mail::to('goshensoftinc@gmail.com')->send(new SendImageUrl($this->request));
        return response()->json(['success' => 'Email sent' ], 200);

    }

    protected function send(){

    }
}
