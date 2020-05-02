<?php

namespace App\Http\Controllers;

use Session;
use App\Comment;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['comments'] = Comment::orderBy('id', 'desc')->get();
        return view('admin.comments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['comment'] = Comment::find($id);

        if (!$data['comment']) {
            return redirect()->route('comments')->with('error', 'Comment could not be found.');
        }

        return view('admin.comments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => 'required',
        ]);

        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('comments')->with('error', 'Comment could not be updated.');
        }

        // Mail Condition
        if ($request->status != $comment->status) {

            if ($request->status == 'approved') {
                $subject = 'Comment Approved';
                $message = 'Your comment has been approved. Thanks for the visiting on our site. Keep love and support us.';
            } elseif ($request->status == 'spam') {
                $subject = 'Mail Spam';
                $title = 'Comment Spam';
                $message = 'Your comment has been moved to spam for our security reasons. Thanks for the visiting on our site. Keep love and support us.';
            } elseif ($request->status == 'pending') {
                $subject = 'Comment Pending';
                $message = 'Your comment has been pending for approval. Thanks for the visiting on our site. Keep love and support us.';
            }
            // Mail Messages            
            $data = [
                'name' => $request->name,
                'send' => $request->email,
                'subject' => $subject,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $message,
            ];

            $view = 'emails.comments';
            
            try {
                SendEmailJob::dispatch($data, $view);
            } catch (\Exception $exception) {
                return redirect()->back()->with('error', 'Mail could not be sent successfully.');
            }
        }

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->body = $request->body;
        $comment->status = $request->status;
        $comment->save();

        Session::flash('success', 'Comment has been updated successfully.');
        return redirect()->route('comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!$id) {
            return redirect()->back()->with('error', 'Comment cound not be found.');
        }

        if (!empty($request->id)) {
            Comment::whereIn('id', $id)->delete();
        } else {
            return redirect()->back()->with('error', 'Comments cound not be deleted.');
        }
        
        Session::flash('success', 'Comments has been deleted successfully.');
        return redirect()->route('comments');  
    }
}
