<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Session;

class PagesController extends Controller
{
    //
    public function getIndex(){
        $posts = Post::orderBy('created_at','desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function postContact(Request $request)
    {
        $this->validate($request,[
          'email'=>'required|email',
          'message' => 'min:10',
          'subject' => 'min:10'
          ]);

        $data = array(
          'email' => $request->email,
          'bodyMessage' => $request->message,
          'subject' => $request->subject
        );
        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('badmustaofeeq@gmail.com');
            $message->subject($data['subject']);
        });
        Session::flash('success',' Email was sent successfully!');
        return redirect()->route('home');
    }
}
