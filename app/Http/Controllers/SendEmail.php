<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class SendEmail extends Controller
{

public function sendmail()
{
    	$data = array(
    			'name' => "Prakash Prasanna",
    	);

    	Mail::send('mailtemplate', $data, function ($message) use($data) {
    		$message->from('dev.ops@ajv.kiwi', 'Learning Laravel');
    	
    		$message->to('dev.ops@ajv.kiwi')->subject('There is a new enquiry!');
    	});

    dd('Mail Send Successfully');
}

public function mail()
{
  return view('mailtemplate');
}

}
