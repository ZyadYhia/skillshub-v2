<?php

namespace App\Http\Controllers\web;

use App\Enums\RolesEnum;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $data['setting'] = Setting::select('email', 'phone')->first();
        return view('web.contact.index')->with($data);
    }
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('contact'))->withErrors($errors);
        }
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
        ]);
        $users = User::role([RolesEnum::SUPERADMIN, RolesEnum::ADMIN])->get();
        foreach ($users as $user) {
            $user->notify(new MessageNotification(
                $user->name,
                $request->name,
                $request->email,
                $request->subject,
                $request->body
            ));
        }
        $request->session()->flash('success', 'Message sent successfult');
        return back();
    }
}
