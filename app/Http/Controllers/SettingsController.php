<?php

namespace App\Http\Controllers;

use Session;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['settings'] = Setting::firstOrFail();
        return view('admin.settings', $data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'site_name' => 'required|string',
            'site_url' => 'required|url',
            'meta_title' => ($request->meta_title != null) ?'string' : '',
            'meta_description' => ($request->meta_description != null) ?'string' : '',
            'support_mail' => ($request->support_mail != null) ?'email' : '',
            'mail_port' => ($request->mail_port != null) ?'numeric' : '',
            'mail_encryption' => ($request->mail_string != null) ?'string' : '',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_width' => ($request->logo_width != null) ?'string' : '',
            'logo_height' => ($request->logo_height != null) ?'string' : '',
            'favicon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'max_upload_size' => ($request->max_upload_size != null) ?'numeric' : '',
            'timezone' => ($request->timezone != null) ?'string' : '',

        ]);

        $settings = Setting::first();

        //dd($request['maintenance']);

        // Upload Logo
        if ($request->hasFile('logo')) {

            if (file_exists($settings->logo)) {
                unlink($settings->logo);
            }

            $logo  = $request->logo;
            $logo_name = $logo->getClientOriginalName();
            $logo->move('uploads/settings', $logo_name);
            $settings->logo = 'uploads/settings/'. $logo_name;
            $settings->save();
        }

        // Upload Favicon
        if ($request->hasFile('favicon')) {

            if (file_exists($settings->favicon)) {
                unlink($settings->favicon);
            }

            $favicon  = $request->favicon;
            $favicon_name = $favicon->getClientOriginalName();
            $favicon->move('uploads/settings', $favicon_name);
            $settings->favicon = 'uploads/settings/'. $favicon_name;
            $settings->save();
        }

        // Upload Cover Image
        if ($request->hasFile('cover')) {

            if (file_exists($settings->cover)) {
                unlink($settings->cover);
            }

            $cover  = $request->cover;
            $cover_name = $cover->getClientOriginalName();
            $cover->move('uploads/settings', $cover_name);
            $settings->cover = 'uploads/settings/'. $cover_name;
            $settings->save();
        }

        // Save Data
        $settings->site_name = $request->site_name;
        $settings->site_url = $request->site_url;
        $settings->meta_title = $request->meta_title;
        $settings->meta_description = $request->meta_description;
        $settings->copyright = $request->copyright;
        $settings->email = $request->email;
        $settings->logo_width = $request->logo_width;
        $settings->logo_height = $request->logo_height;
        $settings->main_color = $request->main_color;
        $settings->body_color = $request->body_color;
        $settings->header_color = $request->header_color;
        $settings->footer_color = $request->footer_color;
        $settings->mail_driver = $request->mail_driver;
        $settings->mail_host = $request->mail_host;
        $settings->mail_username = $request->mail_username;
        $settings->mail_password = $request->mail_password;
        $settings->mail_port = $request->mail_port;
        $settings->mail_from = $request->mail_from;
        $settings->mail_encryption = $request->mail_encryption;
        $settings->header_code = $request->header_code;
        $settings->footer_code = $request->footer_code;
        $settings->timezone = $request->timezone;
        $settings->max_upload_size = $request->max_upload_size;
        $settings->maintenance = empty($request->maintenance) ? 0 : $request->maintenance;
        $settings->ssl = empty($request->ssl) ? 0 : $request->ssl;
        $settings->app_debug = empty($request->app_debug) ? 0 : $request->app_debug;
        $settings->save();

        // Site Maintenance
        if ($request->maintenance == 0) {
            Artisan::call('up');
        } else {
           Artisan::call('down');
        }

        Session::flash('success','Settings have been updated successfully.');
        return redirect()->back();
    }
}
