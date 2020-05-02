<?php

namespace App\Http\Controllers;

use Session;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('order_id','desc')->get();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('admin.categories.create', compact('parentCategories'));
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
            'name' => 'required|min:2|max:20|unique:categories,name',
            'slug' => 'unique:categories,name',
            'order_id' => 'required|numeric|unique:categories,order_id',
        ]);

        // Category Slug
        if (empty($request->slug)) {
            $slug = Str::slug($request->name);
        } else {
            $slug = Str::slug($request->slug);
        }

        $category = Category::create([
            'name' => ucfirst($request->name),
            'slug' => $slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'parent_id' => empty($request->parent_id) ? null : $request->parent_id,
            'order_id' => $request->order_id,
        ]);

        Session::flash('success', 'Category has been created successfully.');
        return redirect()->route('categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['parentCategories'] = Category::with('children')->whereNull('parent_id')->get();
        $data['category'] = Category::find($id);

        if (!$data['category']) {
            return redirect()->route('categories')->with('error', 'Category could not be updated.');
        }
        
        return view('admin.categories.edit', $data);
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
        $category = Category::find($id);

        $this->validate($request,[
            'name' => ($request->name != $category->name) ? 'unique:categories,name' : '',
            'slug' => ($request->slug != $category->slug) ? 'unique:categories,slug' : '',
            'order_id' => ($request->order_id != $category->order_id) ? 'unique:categories,order_id' : '',
        ]);

        // Category Slug
        if (empty($request->slug)) {
            $slug = $request->name;
        } else {
            $slug = $request->slug;
        }

        // Category ID not found
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Category could not be updated.');
        }

        $category->name = ucfirst($request->name);
        $category->slug = Str::slug($slug);
        $category->parent_id = empty($request->parent_id) ? null : $request->parent_id;
        $category->order_id = empty($request->order_id) ? null : $request->order_id;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->save();

        Session::flash('success', 'Category has been updated successfully.');
        return redirect()->route('categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if (!$category) {
            return redirect()->route('categories')->with('error', 'Category not found.');
        }

        if ($category->has('children')) {
            
            foreach ($category->children as $child) {
                //child->forceDelete();
                $child->parent_id = null;
                $child->save();
            }
        }

        foreach($category->items as $item){
            $item->category_id = null;
            $item->save();
        }

        $category->delete();

        Session::flash('success', 'Category has been deleted successfully.');
        return redirect()->route('categories');
    }
}
