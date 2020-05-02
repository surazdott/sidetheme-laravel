<?php

namespace App\Http\Controllers;

use Session;
use App\Adsense;
use Illuminate\Http\Request;

class AdsenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['adsense'] = Adsense::first();
        return view('admin.adsense', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $adsense = Adsense::firstOrFail();

        $adsense->above_featured = $request->above_featured;
        $adsense->above_latest = $request->above_latest;
        $adsense->above_footer = $request->above_footer;
        $adsense->above_image = $request->above_image;
        $adsense->above_desc = $request->above_desc;
        $adsense->below_desc = $request->below_desc;
        $adsense->above_details = $request->above_details;
        $adsense->above_downloads = $request->above_downloads;
        $adsense->above_tags = $request->above_tags;
        $adsense->below_tags = $request->below_tags;
        $adsense->save();

        Session::flash('success', 'Adsense has been updated successfully.');
        return redirect()->route('adsense');
    }
}
