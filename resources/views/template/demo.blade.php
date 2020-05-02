<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@if(!$item->meta_title){{ $item->name }} @else {{ $item->meta_title }} @endif</title>
    <meta name="description" content="@if(!$item->meta_description){{ $item->short_description }} @else {{ $item->meta_description }} @endif"/>
    <meta name="robots" content="index"/>
    <link rel="canonical" href="{{ URL::current() }}"/>
    <meta property="og:locale" content="{{ app()->getLocale() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@if(!$item->meta_title){{ $item->name }} @else {{ $item->meta_title }} @endif"/>
    <meta property="og:description" content="@if(!$item->meta_description){{ $item->short_description }} @else {{ $item->meta_description }} @endif"/>
    <meta property="og:url" content="{{ URL::current() }}"/>
    <meta property="og:site_name" content="{{ $settings->site_name }}"/>
    <meta property="og:image" content="{{ url($item->image) }}"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="@if(!$item->meta_description){{ $item->short_description }} @else {{ $item->meta_description }} @endif"/>
    <meta name="twitter:title" content="@if(!$item->meta_title){{ $item->name }} @else {{ $item->meta_title }} @endif"/>
    <meta name="twitter:site" content="{{ $settings->site_name }}"/>
    <meta name="twitter:image" content="{{ url($item->image) }}"/>
    <meta name="twitter:creator" content="{{ __('@').app()->getLocale() }}"/>
    <link rel="shortcut icon" href="{{ url($settings->favicon) }}"/> 
    <link rel="apple-touch-icon-precomposed" href="{{ url($settings->favicon) }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" type="text/css"/>
    <div id="sd-preview-bar">
        <div class="sidetheme">
            <div class="sidetheme__logo">
                <a href="{{ $settings->site_url }}">Sidetheme</a>
            </div>
            <div class="sidetheme__remove-frame  js-sidetheme-hide" title="Close this frame">
                <span class="sidetheme__remove-frame-x">&times;</span>
            </div>
            @if(file_exists($item->file))
                <form action="{{ route('item.download', $item->slug) }}" method="post">
                    @csrf
                    <button type="submit" class="sidetheme__button sidetheme__button--download">
                        <i class="fa fa-download"></i> Download
                        <input type="hidden" name="count" value="{{ $item->download }}">
                    </button>
                </form>
            @endif
            @if($item->download_link)
                <form action="{{ route('item.download', $item->slug) }}" method="post">
                    @csrf
                    <button type="submit" class="sidetheme__button sidetheme__button--download">
                        <i class="fa fa-download"></i> Download
                        <input type="hidden" name="count" value="{{ $item->download }}">
                    </button>
                </form>
            @endif
        </div>
        <div class="sidetheme__reopen  js-sidetheme-show" title="Show Preview Bar"></div>
    </div>
    <iframe src="{{ $item->live_demo }}"></iframe>
    <script src="{{ asset('assets/js/demo.js')}}"></script>
</body>
</html>