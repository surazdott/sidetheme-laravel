<?php

namespace App\Http\Controllers;

use App\Item;
use App\User;
use App\Comment;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $data['category_count'] = Category::all()->count();
      $data['items_count'] = Item::all()->count();
      $data['comments_count'] = Comment::all()->count();
      $data['users_count'] = User::where('role', 'user')->count();
      $data['items'] = Item::orderBy('id', 'desc')->take(5)->get();

      return view('admin.dashboard', $data);
    }

    // Server Cache 
    public function clearView() {
        Artisan::call('view:clear');
        if (function_exists('exec')){
            //exec('rm ' . storage_path('logs/*'));
            exec('rm ' . storage_path('logs/*.log'));
        }
        return redirect()->back()->with('success', 'View cache clear successfully.');
    }

    public function clearRoute() {
        Artisan::call('route:clear');
        return redirect()->back()->with('success', 'Route cache clear successfully.');
    }

    public function clearConfig() {
       Artisan::call('config:clear');
       return redirect()->back()->with('success', 'Config cache clear successfully.');
    }

    public function clearOptimize() {
      Artisan::call('optimize:clear');
      return redirect()->back()->with('success', 'Optimize cache clear successfully.');  
    }

    public function clearAuth() {
        Artisan::call('auth:clear-resets');
        return redirect()->back()->with('success', 'Auth cache clear successfully.');
    }

    // Save Cache
    public function saveCache() { 
        Artisan::call('view:cache');
        return redirect()->back()->with('success', 'Cache save successfully.');
    }

    public function saveConfig() {
        Artisan::call('config:cache');
        return redirect()->back()->with('success', 'Config cache save successfully.');
    }

    public function saveRoute() {
        Artisan::call('route:cache');
        return redirect()->back()->with('success', 'Route cache save successfully.');
    }
}
