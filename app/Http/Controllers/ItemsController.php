<?php

namespace App\Http\Controllers;

use Session;
use App\Tag;
use App\Item;
use App\Setting;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::all();
        $data['items'] = Item::orderBy('id', 'desc')->get();
        return view('admin.items.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();
        return view('admin.items.create', $data);
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
            'name' => 'required|min:2|max:100',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'mimes:zip',
            'download_link' => ($request->download_link != null) ? 'url' : '',
            'compatible' => ($request->compatible != null) ? 'string' : '',
            'author' => ($request->author != null) ? 'string' : '',
            'released' => ($request->released != null) ? 'string' : '',
            'version' => ($request->version != null) ? 'string' : '',
            'files_included' => ($request->files_included != null) ? 'string' : '',
            'framework' => ($request->framework != null) ? 'string' : '',
            'documentation' => ($request->documentation != null) ? 'url' : '',
            'live_demo' => ($request->live_demo != null) ? 'url' : '',
        ]);

        // Get File Size in MB
        if ($request->hasFile('file')) {
            $get_size = $request->file('file')->getSize();

            // Value in Bytes
            if ($get_size < 1024) {
                $bytes = $get_size;
                $value = $bytes.' B';
            }

            // Value in Kilo Bytes
            if ($get_size >= 1024) {
                $kilobytes = $get_size/(1024);
                $rounding = round($kilobytes);
                $value = $rounding.' KB';
            }

            // Value in Mega Bytes
            if ($get_size >= 1048576) {
                $megabytes = $get_size/(1048576);
                $rounding = number_format((float)$megabytes, 2, '.', '');
                $value = $rounding.' MB';  
            }

            // Value in Giga Bytes
            if ($get_size >= 1073741824) {
                $gigabytes = $get_size/(1073741824);
                $rounding = number_format((float)$gigabytes, 2, '.', '');
                $value = $rounding.' GB';  
            }

            $file_size = $value;
        }

        // Create unique slug
        if (empty($request->slug)) {
            $slug = $this->uniqueSlug($request->name);
        } else {
            $slug = $this->uniqueSlug($request->slug);
        }

        // Upload Image
        if($request->hasFile('image'))
        {   
            // Make Directory
            if(!File::isDirectory('uploads/items/images')) {

                File::makeDirectory('uploads/items/images', 0777, true, true);
            }

            $image = $request->image;
            $image_name = randomString(15).'.'.$image->getClientOriginalExtension();
            $resize_image = Image::make($image)->resize(1200, null, function ($constraint) {$constraint->aspectRatio();});
            $resize_image->save('uploads/items/images/'.$image_name); 
        }

        // Upload Zip File
        if ($request->hasFile('file')) {

            $upload_size = Setting::first()->max_upload_size;
            $get_size = round(($request->file('file')->getSize())/1024);

            if ($get_size <= $upload_size) {
                $file = $request->file;
                $file_name = Str::slug(config('app.name').'-'.$request->name).'.'.$file->getClientOriginalExtension();
                $file->move('uploads/items/files', $file_name);

            } else {
                return redirect()->back()->with('warning', 'File could not upload more than '.$upload_size. ' MB.')->withInput();
            }
        }

        // Validate Upload File if link exists
        if ($request->download_link and $request->file) {
            return redirect()->back()->with('info', 'File and download link can not upload at the same time.')->withInput();
        }

        $item = Item::create([
            'name' => ucfirst($request->name),
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => ($request->hasFile('image')) ? 'uploads/items/images/'.$image_name : '',
            'file' => ($request->hasFile('file')) ? 'uploads/items/files/' . $file_name : '',
            'download_link' => $request->download_link,
            'category_id' =>  $request->category_id,
            'compatible' => $request->compatible,
            'author' => $request->author,
            'released' => $request->released,
            'version' => $request->version,
            'framework' =>  $request->framework,
            'files_included' => $request->files_included,
            'file_size' => ($request->hasFile('file')) ? $file_size : '',
            'documentation' => $request->documentation,
            'compatible_browser' => $request->compatible_browser,
            'download' => $request->download,
            'live_demo' => $request->live_demo,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ? 1:0,
        ]);

        $item->tags()->attach($request->tags);

        Session::flash('success', 'Item has been created successfully.');
        return redirect()->route('items');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['item'] = Item::find($id);
        $data['categories'] = Category::all();
        $data['tags'] = Tag::all();

        if (!$data['item']) {
            return redirect()->route('items')->with('error', 'Item could not be found.');
        }

        return view('admin.items.edit', $data);
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
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('items')->with('error', 'Item could not be updated.');
        }

        // Create unique slug
        if (empty($request->slug)) {
            $slug = Str::slug($request->name);
        } else {
            $slug = Str::slug($request->slug);
        }

        // Validation
        $this->validate($request, [
            'name' => 'required|min:2|max:100',
            'slug' => ($slug != $item->slug) ? 'unique:items,slug' : '',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'mimes:zip',
            'download_link' => ($request->download_link != null) ? 'url' : '',
            'compatible' => ($request->compatible != null) ? 'string' : '',
            'author' => ($request->author != null) ? 'string' : '',
            'released' => ($request->released != null) ? 'string' : '',
            'version' => ($request->version != null) ? 'string' : '',
            'files_included' => ($request->files_included != null) ? 'string' : '',
            'framework' => ($request->framework != null) ? 'string' : '',
            'documentation' => ($request->documentation != null) ? 'url' : '',
            'live_demo' => ($request->live_demo != null) ? 'url' : '',
        ]);

        // Get File Size in MB
        if ($request->hasFile('file')) {
            $get_size = $request->file('file')->getSize();

            // Value in Bytes
            if ($get_size < 1024) {
                $bytes = $get_size;
                $value = $bytes.' B';
            }
            
            // Value in Kilo Bytes
            if ($get_size >= 1024) {
                $kilobytes = $get_size/(1024);
                $rounding = round($kilobytes);
                $value = $rounding.' KB';
            }

            // Value in Mega Bytes
            if ($get_size >= 1048576) {
                $megabytes = $get_size/(1048576);
                $rounding = number_format((float)$megabytes, 2, '.', '');
                $value = $rounding.' MB';  
            }

            // Value in Giga Bytes
            if ($get_size >= 1073741824) {
                $gigabytes = $get_size/(1073741824);
                $rounding = number_format((float)$gigabytes, 2, '.', '');
                $value = $rounding.' GB';  
            }

            $file_size = $value;
        }

        // If request has image file
        if($request->hasFile('image'))
        {   
            // Delete existing image
            if(File::exists($item->image)) {
                File::delete($item->image);
            }

            // Make Directory
            if(!File::isDirectory('uploads/items/images')) {

                File::makeDirectory('uploads/items/images', 0777, true, true);
            }

            // Upload new image
            $image = $request->image;
            $image_name = randomString(15).'.'.$image->getClientOriginalExtension();
            $resize_image  = Image::make($image)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();});
            $resize_image->save('uploads/items/images/'.$image_name); 
            // Old image
            $item->image = 'uploads/items/images/' . $image_name;
            $item->save();
        }

        // Upload Zip File
        if ($request->hasFile('file')) {
            // Delete Old File
            if (File::exists($item->file)) {
                File::delete($item->file);
            }
            // Upload New File
            $upload_size = Setting::first()->max_upload_size;
            $get_size = round(($request->file('file')->getSize())/1024);

            if ($get_size <= $upload_size) {
	            $file = $request->file;
	            $file_name = Str::slug(config('app.name').'-'.$request->name).'.'.$file->getClientOriginalExtension();
	            $file->move('uploads/items/files', $file_name);
	            $item->file = 'uploads/items/files/'.$file_name;
	            $item->save();	
            } else {
            	return redirect()->back()->with('warning', 'File could not upload more than '.$upload_size. ' MB.')->withInput();
            }
        }

        // Delete file if download link 
        if ($request->download_link != null) {
            if (file_exists($item->file)) {
                unlink($item->file);
            }
        }

        // Validate Upload File if link exists
        if ($request->download_link and $request->file) {
            return redirect()->back()->with('info', 'File and download link can not upload at the same time.')->withInput();
        }

        // Update Data
        $item->name = ucfirst($request->name);
        $item->slug = $slug;
        $item->short_description = $request->short_description;
        $item->description = $request->description;
        $item->download_link = $request->download_link;
        $item->category_id =  $request->category_id;
        $item->compatible = $request->compatible;
        $item->author = $request->author;
        $item->released = $request->released;
        $item->version = $request->version;
        $item->framework =  $request->framework;
        $item->files_included = $request->files_included;
        $item->file_size = $request->has('file') ? $file_size : $item->file_size;
        $item->documentation = $request->documentation;
        $item->compatible_browser = $request->compatible_browser;
        $item->download = $request->download;
        $item->live_demo = $request->live_demo;
        $item->meta_title = $request->meta_title;
        $item->meta_description = $request->meta_description;
        $item->status = $request->status ? 1:0;
        $item->save();

        $item->tags()->sync($request->tags);

        Session::flash('success', 'Item has been updated successfully.');
        return redirect()->route('items');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;

        if (empty($request->id)) {
            return redirect()->back()->with('error', 'Items cound not be deleted.');
        } else {
            Item::whereIn('id', $id)->delete();
        }

        Session::flash('success', 'Item has been moved in trash.');
        return redirect()->route('items');
    }

    /**
     * Display a trashed of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed() {
        $data['items'] = Item::onlyTrashed()->get();
        return view('admin.items.trashed', $data);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( Request $request)
    {
        $id = $request->id;

        if (empty($request->id)) {
            return redirect()->back()->with('error', 'Items cound not be restored.');
        } else {
            Item::withTrashed()->whereIn('id', $id)->restore();
        }

        Session::flash('success', 'Item has been restored successfully.');
        return redirect()->route('items');
    }

    /**
     * Destroy  the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::withTrashed()->where('id', $id)->first();

        if (!$item) {
            return redirect()->back()->with('error', 'Items cound not be deleted.');
        } else {
            // Delete Image File
            if (File::exists($item->image)) {
                File::delete($item->image);
            }

            // Delete Zip File
            if (File::exists($item->file)) {
                File::delete($item->file);
            }
        
            $item->forceDelete();

            Session::flash('success', 'Item has been deleted successfully.');
            return redirect()->back();
        }
    }

    //For Generating Unique Slug Our Custom function
    public function uniqueSlug($name, $id = 0)
    {
        // Normalize the name
        $slug = Str::slug($name);
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
        return Item::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
}
