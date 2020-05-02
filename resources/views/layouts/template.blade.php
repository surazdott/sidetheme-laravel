<!DOCTYPE  html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> @hasSection ('title') @yield('title') @else {{ $settings->meta_title }} @endif</title>
    <meta name="description" content="@hasSection ('description') @yield('description') @else {{ $settings->meta_description }} @endif"/>
    <meta name="robots" content="index"/>
    <link rel="canonical" href="{{ URL::current() }}"/>
    <meta property="og:locale" content="{{ app()->getLocale() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@hasSection ('ogtitle') @yield('ogtitle') @else {{ $settings->meta_title }} @endif"/>
    <meta property="og:description" content="@hasSection ('ogdesc') @yield('ogdesc') @else {{ $settings->meta_description }} @endif"/>
    <meta property="og:url" content="{{ URL::current() }}"/>
    <meta property="og:site_name" content="{{ $settings->site_name }}"/>
    <meta property="og:image" content="@hasSection ('ogimage') @yield('ogimage') @else {{ url($settings->cover) }} @endif"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="@hasSection ('twitter_desc') @yield('twitter_desc') @else {{ $settings->meta_description }} @endif"/>
    <meta name="twitter:title" content="@hasSection ('twitter_title') @yield('twitter_title') @else {{ $settings->meta_title }} @endif"/>
    <meta name="twitter:site" content="{{ $settings->site_name }}"/>
    <meta name="twitter:image" content="@hasSection ('twitter_image') @yield('twitter_image') @else {{ url($settings->cover) }} @endif"/>
    <meta name="twitter:creator" content="{{ __('@').app()->getLocale() }}"/>
    <link rel="shortcut icon" href="{{ url($settings->favicon) }}"/> 
    <link rel="apple-touch-icon-precomposed" href="{{ url($settings->favicon) }}"/>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    @yield('styles')
    {!! $settings->header_code !!}
</head>
<body>
<!-- Top menu -->
<nav class="navbar navbar-dark fixed-top navbar-expand-md navbar-no-bg">
    <div class="container">
        <a href="{{ $settings->site_url }}"><img src="{{ url($settings->logo) }}" class="navbar-brand" width="{{ $settings->logo_width }}" height="{{ $settings->logo_height }}" alt="{{ $settings->site_name }}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @foreach($categories as $category)
                @if($category->parent_id == null)
                <li class="nav-item dropdown">
                    <a class="nav-link @if($category->children->count() > 0) dropdown-toggle @endif" href="{{ route('category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
                    @if($category->children->count() > 0)
                        <div class="dropdown-menu menu-dark" aria-labelledby="navbarDropdown">
                        @foreach($category->children as $child)
                            <a class="dropdown-item item-dark" href="{{ route('category', ['slug' => $child->slug]) }}">{{ $child->name }}</a>
                        @endforeach
                        </div>
                    @endif
                </li>
                @endif
                @endforeach
                <li class="nav-item">
                    @if (Route::has('login'))
                    @auth
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="btn btn-outline-secondary" href="{{ url('admin/dashboard') }}"> {{ Auth::user()->name}} ! </a>
                          </div>
                        </li>
                    </ul>
                     @else
                        <a class="btn btn-outline-secondary" href="{{ url('login') }}"><i class="fa fa-user"></i> Login</a>
                    @endauth
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield('contents')
<!-- Footer -->
<footer class="footer bg-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                <ul class="list-inline mb-2">
                    <li class="list-inline-item">
                        <a href="{{ route('contact.us') }}">Contact Us</a>
                    </li>
                    @foreach($pages as $page)
                    <li class="list-inline-item">⋅</li>
                    <li class="list-inline-item">
                        <a href="{{ route('page', ['slug' => $page->slug]) }}">{{ $page->name }}</a>
                    </li>
                    @endforeach
                </ul>
                <p class="text-muted small mb-4 mb-lg-0">{!! $settings->copyright !!}</p>
            </div>
            <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fa fa-facebook fa-2x fa-fw"></i>
                        </a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="#">
                            <i class="fa fa-twitter-square fa-2x fa-fw"></i>
                    </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fa fa-instagram fa-2x fa-fw"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@yield('scripts')
{!! $settings->footer_code !!}
</body>
</html>