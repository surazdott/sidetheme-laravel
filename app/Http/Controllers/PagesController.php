<?php

namespace App\Http\Controllers;

use Session;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pages'] = Page::orderBy('id', 'desc')->get();
        return view('admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'name' => 'required|min:2|string',
        ]);

        // Slug URL for Pages
        if (empty($request->slug)) {
            $slug = $this->uniqueSlug($request->name);
        } else {
            $slug = $this->uniqueSlug($request->slug);
        }

        // Save Data
        $page = Page::create([
            'name' => ucfirst($request->name),
            'slug' => $slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ? 1:0,
        ]);

        Session::flash('success', 'Page has been created successfully.');
        return redirect()->route('pages');
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
        // Find Page ID
        $page = Page::find($id);

        // If ID does not exists
        if (!$page) {
            return redirect()->route('pages')->with('error', 'Page could not be found.');
        } else {

            return view('admin.pages.edit', compact('page'));
        }
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
        $page = Page::find($id);

        // If ID does not exists
        if (!$page) {
            return redirect()->route('pages')->with('error', 'Page could not be found.');
        }

        // Slug URL for Pages
        if (empty($request->slug)) {
            $slug = $this->uniqueSlug($request->name);
        } else {
            $slug = $request->slug;
        }

        $this->validate($request, [
            'name' => 'required|min:2|string',
            'slug' => ($slug != $page->slug) ? 'unique:pages,slug' : '',
        ]);

        // Update Page
        $page->name = ucfirst($request->name);
        $page->slug = $slug;
        $page->content = $request->content;
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->status = $request->status ? 1:0;
        $page->save();

        // Successfully Save
        Session::flash('success', 'Page has been updated successfully.');
        return redirect()->route('pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if (!$page) {
            return redirect()->route('pages')->with('error', 'Sorry! Page not found.');
        } else {

            // Delete Page
            $page->delete();

            // Successfully Delete
            Session::flash('success', 'Page has been deleted successfully.');
            return redirect()->route('pages');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //For Generating Unique Slug Our Custom function
    public function uniqueSlug($title, $id = 0)
    {
        // Normalize the name
        $slug = Str::slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Page::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
