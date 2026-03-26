<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
     public function contact()
    {
        return view('static.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message
    ]);

        // For now just return success
        return back()->with('success', 'Message sent successfully!');
    }
}
