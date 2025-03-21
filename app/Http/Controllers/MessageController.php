<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\ContactResponseMail;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::where('isResponsed','unread')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.messages.index')->with($data);
    }
    public function show(Message $message)
    {
        $message->update([
            'isResponsed'=>'read',
        ]);
        $data['message'] = $message;
        return view('admin.messages.show')->with($data);
    }
    public function response(Message $message, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $receiverMail = $message->email;
        $receiverName = $message->name;
        Mail::to($receiverMail)->send(new ContactResponseMail($receiverName ,$request->title ,$request->body));
        return redirect(url('dashboard/messages'));
    }
}
