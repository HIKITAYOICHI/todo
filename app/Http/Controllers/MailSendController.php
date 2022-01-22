<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailSendController extends Controller
{
    public function send(){

    	$data = [];

    	Mail::send('emails.test', $data, function($message){
    	    $message->to('testmail1234qwer@gmail.com', 'Admin')
    	            ->subject('This is a test mail');
    	});
    }
}
