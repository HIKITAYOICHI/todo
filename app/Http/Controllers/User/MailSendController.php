<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mail;

class MailSendController extends Controller
{
    //ユーザー登録時のメール送信
    public function send(){

    	$data = [];

    	Mail::send('emails.new_user', $data, function($message){
    	    $message->to('testmail1234qwer@gmail.com', 'Tester')
    	            ->subject('New User Login')
    	            ->from('testmail1234qwer@gmail.com', 'Admin');
    	});
    	return redirect('user/tasks');
    }
    //Todo編集時のメール送信
    public function edit(){
        
        $data = [];
        Mail::send('emails.edit_todo', $data, function($message){
            
            $user_email = Auth::user()->email;
            
            $message->to($user_email, 'User')
                    ->subject('Todo has been edited.')
                    ->from('testmail1234qwer@gmail.com', 'Admin');
            
        });
        return redirect('user/tasks');
    }

}
