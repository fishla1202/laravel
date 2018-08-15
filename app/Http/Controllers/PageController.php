<?php

namespace App\Http\Controllers;

use App\User;
Use Mail;
Use App\Mail\ContactForm;
use Illuminate\Http\Request;

class PageController extends Controller 
{
    public function about() 
    {
        return "About Us Page";
    }

    public function contact() {
        return view('contact');
    }

    public function sendContact(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:10'
        ]);

        Mail::to('admin@example.com')->send(new ContactForm($request));

        return redirect('/');
       
    }

    public function profile($id) {
        //eager loading
        $user = User::with(['questions', 'answers', 'answers.question'])->findOrFail($id);
        return view('profile')->with('user', $user);
    }
}