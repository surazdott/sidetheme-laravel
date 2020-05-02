<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Item;
use App\Page;
use App\Category;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all()->first();
        $categories = Category::all()->first();
        $tags = Tag::all()->first();
        $pages = Page::all()->first();

        return response()->view('sitemap.index', [
            'items' => $items,
            'categories' => $categories,
            'tags' => $tags,
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function items()
    {
        $items = Item::latest()->get();
        return response()->view('sitemap.items', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories()
    {
        $categories = Category::all();
        return response()->view('sitemap.categories', [
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }

    public function tags()
    {
        $tags = Tag::latest()->get();
        return response()->view('sitemap.tags', [
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }

    public function pages()
    {
        $pages = Page::all();
        return response()->view('sitemap.pages', [
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
}
