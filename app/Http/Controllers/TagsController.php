<?php

namespace App\Http\Controllers;

use Session;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::orderBy('id', 'desc')->get();
        return view('admin.tags.index', $data);
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
            'name' => 'required|unique:tags,slug',
            'slug' => 'unique:tags,name',
        ]);

        // Tag Slug
        if (empty($request->slug)) {
            $slug = Str::slug($request->name);
        } else {
            $slug = Str::slug($request->slug);
        }

        $tag = Tag::create([
            'name' => ucfirst($request->name),
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        Session::flash('success', 'Tag has been created successfully.');
        return redirect()->route('tags');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tag'] = Tag::find($id);

        if (!$data['tag']) {
            return redirect()->route('tags')->with('error', 'Tag could not be found.');
        }

        return view('admin.tags.edit', $data);
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
        $tag = Tag::find($id);

        if (!$tag) {
            return redirect()->route('tags')->with('error', 'Tag could not be updated.');
        }

        $this->validate($request, [
            'name' => ($request->name != $tag->name) ? 'unique:tags,name' : '',
            'slug' => ($request->slug != $tag->slug) ? 'unique:tags,slug' : '',
        ]);

        // Tag Slug
        if (empty($request->slug)) {
            $slug = Str::slug($request->name);
        } else {
            $slug = Str::slug($request->slug);
        }

        $tag->name = $request->name;
        $tag->slug = $slug;
        $tag->meta_title = $request->meta_title;
        $tag->meta_description = $request->meta_description;
        $tag->save();

        Session::flash('success', 'Tag has been updated successfully.');
        return redirect()->route('tags');
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
            return redirect()->back()->with('error', 'Tags cound not be found.');
        }

        if (!empty($request->id)) {
            Tag::whereIn('id', $id)->delete();
        } else {
            return redirect()->back()->with('error', 'Tags cound not be deleted.');
        }
        
        Session::flash('success', 'Tags has been deleted successfully.');
        return redirect()->route('tags');
    }
}
