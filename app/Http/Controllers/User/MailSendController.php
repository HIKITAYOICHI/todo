<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class MailSendController extends Controller
{
    public function send(){

    	$data = [];

    	Mail::send('emails.new_user', $data, function($message){
    	    $message->to('testmail1234qwer@gmail.com', 'Tester')
    	            ->subject('New User Login')
    	            ->from('testmail1234qwer@gmail.com', 'Admin');
    	});
    	return redirect('user/tasks');
    }
    
}
