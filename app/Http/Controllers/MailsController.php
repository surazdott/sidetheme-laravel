<?php

namespace App\Http\Controllers;

use Session;
use App\Mail;
use App\User;
use App\Subscriber;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mails.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $subscribers = Subscriber::where('status', 1)->get();
        $users = User::where('role', 'user')->get();
        $send_to = array();

        $this->validate($request, [
            'subject' => 'required',
            'to' => 'required',
            'message' => 'required', 
        ]);

        if ($request->to == 'users') {
            foreach ($users as $user) {
                $send_to[] = $user->email;
            };
        }

        if ($request->to == 'subscribers') {
            foreach ($subscribers as $subscriber) {
                $send_to[] = $subscriber->email;
            };
        }
          
        $data = [
            'send' => $send_to,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $view = 'emails.mails';
       
        try {
            SendEmailJob::dispatch($data, $view);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Mail could not be sent successfully.');
        }

        // Successfull Created
        Session::flash('success', 'Mail has been send successfully.');
        return redirect()->route('mails');
    }
}
