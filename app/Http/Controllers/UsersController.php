<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('id', 'desc')->where('id', '!=', auth()->id())->get();
        return view('admin.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'avatar' => 'image|mimes:png,jpg,jpeg,gif'
        ]);

        // Upload User Avatar
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatar_name = randomString(15).'.'.$avatar->getClientOriginalExtension();
            $avatar->move('uploads/users', $avatar_name);  
        }

        // Save User Data
        $user = User::create([
            'name' => ucfirst($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => ($request->hasFile('avatar')) ? 'uploads/users/'.$avatar_name : '',
            'role' => $request->role,
            'status' => $request->status ? 1:0,
        ]);

        // Send Mail
        $data = [
            'send' => $request->email,
            'subject' => 'Account Registration',
            'title' => 'Thanks for Registering at '.config('app.name'),
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'message' => 'Thank you for registering a account at '.config('app.name'). '. Your account details are as follows : ',
        ];

        $view = 'emails.user';
        
        try {
            SendEmailJob::dispatch($data, $view);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Mail could not be sent successfully.');
        }

        Session::flash('success', 'User has been created successfully.');
        return redirect()->route('users');
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
        $data['user'] = User::find($id);
        return view('admin.users.edit', $data);
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
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'User could not be updated.');
        }

        $this->validate($request, [
            'name' => 'required|string|min:2|max:50',
            'email' => ($request->email != $user->email) ? 'unique:users,email|email' : '',
            'password' => ($request->password) ? 'string|min:8' : '',
            'role' => 'required',
            'avatar' => 'image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        // Upload Profile Picture
        if($request->hasFile('avatar')) {   
            // Delete Old Image
            if (file_exists($user->avatar)) {
                unlink($user->avatar);
            }
            // Upload New Image
            $avatar = $request->avatar;
            $avatar_name = randomString(15).'.'.$avatar->getClientOriginalExtension();
            $avatar->move('uploads/users', $avatar_name);
            $user->avatar = 'uploads/users/'.$avatar_name;
            $user->save();
        }

        // User Status
        if ($request->status != $user->status) {
            if ($request->status == 1) {
                $data = [
                    'send' => $request->email,
                    'subject' => 'User Activated',
                    'name' => $request->name,
                    'email' => $request->email,
                    'message' => 'Your account has been activated at our site. Thanks for creating the account. Please visiting and support us.',
                ];

                $view = 'emails.status';
                
                try {
                    SendEmailJob::dispatch($data, $view);
                } catch (\Exception $exception) {
                    return redirect()->back()->with('error', 'Mail could not be sent successfully.');
                }
            }

            // User Status
            if ($request->status == 0) {
                $data = [
                    'send' => $request->email,
                    'subject' => 'User Banned',
                    'name' => $request->name,
                    'email' => $request->email,
                    'message' => 'We are applogized that your account has been banned for the suspicious activity. If you have any issue please mail us at support@sidetheme.com.',
                ];

                $view = 'emails.status';
                
                try {
                    SendEmailJob::dispatch($data, $view);
                } catch (\Exception $exception) {
                    return redirect()->back()->with('error', 'Mail could not be sent successfully.');
                }
            }
        } 

        // Save Profile Data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status =$request->status ? 1:0;
        $user->save();

        // Password Change Mail
        if (!empty($request->password)) {

            // Mail Messages            
            $data = [
                'send' => $request->email,
                'subject' => 'Account Updated',
                'title' => 'Account Updated',
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'message' => 'We have updated your account information. Your new account details are as follows : ',
            ];

            $view = 'emails.user';

            try {
                SendEmailJob::dispatch($data, $view);
            } catch (\Exception $exception) {
                return redirect()->back()->with('error', 'Mail could not be sent successfully.');
            }
        }

        // Successfully Updated
        Session::flash('success', 'Profile has been updated successfully.');
        return redirect()->route('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find User by ID
        $user = User::find($id);

        // ID Validation
        if (!$user) {
            return redirect()->route('users')->with('error', 'User could not be found.');
        }
    
        // Prevent Logged In User
        if (Auth::user()->id == $id) {

            return redirect()->route('users')->with('error', 'Auth user could not be deleted.');
            
        } else {

            if (file_exists($user->avatar)) {
                unlink($user->avatar);
            }

            $user->delete();           
        }

        Session::flash('success', 'User has been deleted successfully.');
        return redirect()->route('users');
    }

    public function changePassword() {
        return view('admin.users.password');
    }

    public function updatePassword(Request $request)
    {
        // Auth User Validation
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        // Auth User Data
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'The specified password does not match the database password.');
        } else {
            // write code to update password
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', 'Password has been changed successfully.');
        }
    }

    public function profile() {
        $data['user'] = Auth::user();
        return view('admin.users.profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:50',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        // Upload Profile Picture
        if($request->hasFile('avatar')) {   
            // Delete Old Image
            if (file_exists($user->avatar)) {
                unlink($user->avatar);
            }
            // Upload New Image
            $avatar = $request->avatar;
            $avatar_name = randomString(15).'.'.$avatar->getClientOriginalExtension();
            $avatar->move('uploads/users', $avatar_name);
            $user->avatar = 'uploads/users/'.$avatar_name;
            $user->save();
        }

        // Save Profile Data
        $user->name = $request->name;
        $user->save();

        // Successfully Updated
        Session::flash('success', 'Profile has been updated successfully.');
        return redirect()->back();
    }
}
