<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Item;
use App\Page;
use App\Comment;
use App\Adsense;
use App\Setting;
use App\Category;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['adsense'] = Adsense::first();
        $data['pages'] = Page::where('status', 1)->take(5)->get();
        $data['featured'] = Item::where('status', 1)->orderBy('id', 'desc')->take(8)->get();
        $data['latest'] = Item::orderBy('id', 'desc')->orderBy('id', 'desc')->skip(8)->take(8)->get();

        return view('template.index', $data);
    }

    # Items by Category
    public function category($slug)
    {
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['pages'] = Page::where('status', 1)->take(5)->get();
        $data['category'] = Category::with(['items', 'itemsByParent'])->where('slug', $slug)->first();
        // Data Merge
        if ($data['category']) {
            $data['items'] = $data['category']->items->merge($data['category']->itemsByParent)->paginate(12);
        } else {
            return abort(404);
        }

        return view('template.category', $data);
    }

    # Single Item Page
    public function item($slug)
    {
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['adsense'] = Adsense::first();
        $data['pages'] = Page::where('status', 1)->take(5)->get();
        $data['item'] = Item::where('slug', $slug)->first();

        if ($data['item']) {
            $data['comments'] = $data['item']->comments()->where('status', 'approved')->orderBy('id', 'desc')->get();
            $data['tags'] = Tag::all();   
        } else {
            abort(404);
        }

        return view('template.item', $data);
    }

    # Save Comments from Item Page
    public function commentStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'email' => 'required|email',
            'body' => 'required|string',
        ]);

        $comment = Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'body' => $request->body,
            'item_id' => $request->item_id,
            'parent_id' => $request->parent_id,
        ]);

        return back();
    }

    # Dynamic Pages
    public function page($slug) {
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['pages'] = Page::where('status', 1)->take(5)->get();
        $data['page'] = Page::where('slug', $slug)->first();

        if (!$data['page']) {
            abort(404);
        } else {
            
            if ($data['page']->status == 0) {
                abort(404);
            }
        }

        return view('template.page', $data);
    }

    # Items by Tag
    public function tag($slug)
    {
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['pages'] = Page::where('status', 1)->take(5)->get();
        $data['tag'] = Tag::where('slug', $slug)->first();

        if ($data['tag']) {
            $data['items'] = $data['tag']->items()->orderBy('id', 'desc')->paginate(12);
        } else {
            abort(404);
        }

        return view('template.tag', $data);
    }

    # Search Items
    public function search(Request $request)
    {
        $data['query'] = Request('query');
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['pages'] = Page::where('status', 1)->take(5)->get();
        $data['items'] = Item::where('name','like',  '%' . request('query') . '%')->paginate(12);
        
        return view('template.results', $data); 
    }

    # Contact Us Page
    public function contactUs() {
        $data['settings'] = Setting::first();
        $data['categories'] = Category::orderBy('order_id')->get();
        $data['pages'] = Page::where('status', 1)->take(5)->get();

        return view('template.contact', $data);
    }

    # Send Message to Admin
    public function sendMessage(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $settings = Setting::first();

        $data = [
            'send' => $settings->email,
            'subject' => $request->subject,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        $view = 'emails.contact';
        SendEmailJob::dispatch($data, $view);

        return redirect()->back()->with('success', 'Thanks for contacting us!');
    }

    # Item Demo Page
    public function demo($slug)
    {
        $data['settings'] = Setting::first();
        $data['item'] = Item::where('slug', $slug)->first();

        if (!$data['item']) {
            abort(404);
        }

        return view('template.demo', $data);
    }

    # Secure Download URL and Count Download
    public function download(Request $request, $slug)
    {
        $item = Item::where('slug', $slug)->firstOrFail();

        if (!$item->slug) {
            abort(404);
        }

        # Download count by 1 and save
        $item->download = $request->count+1;
        $item->save();

        # File Exists in Server
        if (file_exists($item->file)) {
            //$pathToFile = public_path($item->file);
            //return response()->download($pathToFile);
            return redirect(url($item->file));
        } else {
            # Download File from Link
            return redirect($item->download_link);
        }
    }
}
