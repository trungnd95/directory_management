<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Http\Requests;
use App\Feedback;
use Mail;
use Alert;

class FeedbackController extends Controller
{
	/**
	 * Get view feedback 
	 * @return 
	 */
    public function feedback()
    {
    	return view('templates.Feedbacks.feedback');
    }

    /**
     * Send Email and Store data to database
     * @return 
     */
    public function sendFeedback()
    {
    	$email = Request::input('email');
    	$content = Request::get('feedback');
    	$feedback = new Feedback;
    	$feedback->email =  $email;
    	$feedback->content =  $content;
    	$feedback->save();

    	//Send email 
    	$data = ['email'=> $email,'content'=> $content];
    	Mail::send('templates.Feedbacks.email',$data,function($message) use ($data) {
    		$message->from($data['email'],'Guest Feedback');
    		$message->to('admin.directory@gmail.com','Admin')->subject('Feedback');
    	});

    	Alert::success("Continute with other action","Feedback success")->persistent('Close');
    	
    	return redirect("/");
    }

    /**
     * List all feedback from database
     * @return
     */
    public function listFeedback()
    {

    }

    /**
     * Update feedback if it was replied
     */
    public function update($id)
    {
        
    }
}
