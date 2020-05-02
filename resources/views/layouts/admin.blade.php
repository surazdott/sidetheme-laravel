<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @hasSection ('title') @yield('title') @else Dashboard @endif</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}"/> 
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/favicon.png') }}"/>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/toastr/toastr.min.css') }}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    @yield('styles')
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a href="{{ url('admin') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" class="brand" width="150px" height="33px" alt="{{ config('app.name') }}"> 
                    <img src="{{ asset('assets/img/mini-logo.png') }}" class="brand-mini" width="30px" height="30px" alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler" href="javascript:;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link search-toggler js-search-toggler"><i class="ti-search"></i>
                            <span>Search here...</span>
                        </a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link toolbar-icon" href="{{ config('app.url') }}" target="_blank"><i class="ti-eye"></i>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link toolbar-icon" href="{{ route('mails') }}"><i class="ti-email"></i>
                        </a>
                    </li>
                    <li class="dropdown dropdown-notification">
                        <a class="nav-link dropdown-toggle toolbar-icon" data-toggle="dropdown" href="javascript:;"><i class="ti-bell rel"><span class="notify-signal"></span></i></a>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span>{{ Auth::user()->name }}</span>
                            <img src="@if(file_exists(Auth::user()->avatar)){{ url(Auth::user()->avatar) }}@else {{ asset('assets/img/user.jpg') }}@endif" alt="{{ Auth::user()->name }}" />
                        </a>
                        <div class="dropdown-menu dropdown-arrow dropdown-menu-right admin-dropdown-menu">
                            <div class="dropdown-arrow"></div>
                            <a href="{{ route('profile') }}" class="dropdown-item"><i class="fa fa-user"></i> Manage Profile </a>
                            <a href="{{ route('password.change') }}" class="dropdown-item"><i class="fa fa-key"></i> Change Password </a>
                            <a href="{{ route('settings') }}" class="dropdown-item"><i class="fa fa-gear"></i>Settings </a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-sign-out"></i> Log Out </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                            </form>
                        </div>
                    </li>
                    <li>
                        <a class="nav-link quick-sidebar-toggler">
                            <span class="ti-align-right"></span>
                        </a>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar" style="position: fixed;">
            <div id="sidebar-collapse">
                <ul class="side-menu metismenu">
                    <li class="{{ active('admin/dashboard') }}">
                        <a href="{{ route('dashboard') }}"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    @if(Auth::user()->role == 'admin')
                        <li class="heading">Features</li>
                        <li class="{{ active('admin/categories') }}{{ active('admin/category/*') }}">
                            <a href="{{ route('categories') }}"><i class="sidebar-item-icon ti-folder"></i>
                                <span class="nav-label">Categories</span>
                            </a>
                        </li>
                        <li class="{{ active('admin/items') }}{{ active('item/*') }}">
                            <a href="javascript:;"><i class="sidebar-item-icon ti-list"></i>
                                <span class="nav-label">Items</span><i class="fa fa-angle-left arrow"></i></a>
                            <ul class="nav-2-level collapse">
                                <li>
                                    <a href="{{ route('item.create') }}" class="{{ active('admin/item/create') }}">Add Item</a>
                                </li>
                                <li>
                                    <a href="{{ route('items') }}" class="{{ active('admin/items') }}">View Items</a>
                                </li>
                                <li>
                                    <a href="{{ route('item.trashed') }}" class="{{ active('admin/item/trashed') }}">Trashed</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ active('comments') }}{{ active('comment/*') }}">
                            <a href="{{ route('comments') }}"><i class="sidebar-item-icon ti-comments"></i>
                                <span class="nav-label">Comments</span>
                            </a>
                        </li>
                        <li class="{{ active('tags') }}{{ active('tag/*') }}">
                            <a href="{{ route('tags') }}"><i class="sidebar-item-icon ti-tag"></i>
                                <span class="nav-label">Tags</span>
                            </a>
                        </li>
                        <li class="{{ active('pages') }}{{ active('page/*') }}">
                            <a href="{{ route('pages') }}"><i class="sidebar-item-icon ti-book"></i>
                                <span class="nav-label">Pages</span>
                            </a>
                        </li>
                        <li class="{{ active('adsense') }}">
                            <a href="{{ route('adsense') }}"><i class="sidebar-item-icon ti-money"></i>
                                <span class="nav-label">Adsense</span>
                            </a>
                        </li>
                        <li class="{{ active('mails') }}">
                            <a href="{{ route('mails') }}"><i class="sidebar-item-icon ti-email"></i>
                                <span class="nav-label">Mails</span>
                            </a>
                        </li>
                        <li class="{{ active('users') }}{{ active('user/*') }}">
                            <a href="{{ route('users') }}"><i class="sidebar-item-icon ti-user"></i>
                                <span class="nav-label">Users</span>
                            </a>
                        </li>
                        <li class="{{ active('settings') }}">
                            <a href="{{ route('settings') }}"><i class="sidebar-item-icon ti-settings"></i>
                                <span class="nav-label">Settings</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            @yield('contents')
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">{{ date('Y') }} © <b>{{ config('app.name') }}</b> All Rights Reserved. </div>
                <div>
                    <a class="px-3 pl-4">Version 1.0.3</a>
                    <a class="px-3">Suraj Datheputhe</a>
                </div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- START SEARCH PANEL-->
    <form class="search-top-bar" action="#">
        <input class="form-control search-input" type="text" placeholder="Search...">
        <button class="reset input-search-icon"><i class="ti-search"></i></button>
        <button class="reset input-search-close" type="button"><i class="ti-close"></i></button>
    </form>
    <!-- END SEARCH PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- QUICK SIDEBAR-->
    <div class="quick-sidebar">
        <ul class="nav nav-tabs tabs-line">
            <li class="nav-item">
                <a class="nav-link active" href="#tab-2" data-toggle="tab"><i class="ti-server"></i>
                    <div>Database</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tab-3" data-toggle="tab"><i class="ti-settings"></i>
                    <div>Server</div>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-2">
                <div class="scroller">
                    <div class="font-bold mb-4 mt-2">Database Cache<br><small>Remove the configuration cache file</small></div>
                    <div class="settings-item">Clear View
                        <a href="{{ route('clear.view') }}" class="badge badge-primary badge-pill">Clear Now</a>
                    </div>
                    <div class="settings-item">Clear Route
                        <a href="{{ route('clear.route') }}" class="badge badge-primary badge-pill">Clear Now</a>
                    </div>
                    <div class="settings-item">Clear Config
                        <a href="{{ route('clear.config') }}" class="badge badge-primary badge-pill">Clear Now</a>
                    </div>
                    <div class="settings-item">Clear Optimize
                        <a href="{{ route('clear.optimize') }}" class="badge badge-primary badge-pill">Clear Now</a>
                    </div>
                    <div class="settings-item">Flush Auth
                        <a href="{{ route('clear.auth') }}" class="badge badge-primary badge-pill">Clear Now</a>
                    </div>
                    <div class="font-bold mb-4 mt-2">Save Cache<br><small>Save cache file for faster configuration</small></div>
                    <div class="settings-item">Save Config
                        <a href="{{ route('save.config') }}" class="badge badge-primary badge-pill">Save Now</a>
                    </div>
                    <div class="settings-item">Save Route
                        <a href="{{ route('save.route') }}" class="badge badge-primary badge-pill">Save Now</a>
                    </div>
                    <div class="settings-item">Save View
                        <a href="{{ route('save.view') }}" class="badge badge-primary badge-pill">Save Now</a>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-3">
                <div class="scroller">
                    <div class="font-bold mb-4 mt-2">Server Information</div>
                    <div class="settings-item">Website Name
                        <label class="badge badge-primary badge-pill">{{ config('app.name') }}</label>
                    </div>
                    <div class="settings-item">PHP Version 
                        <label class="badge badge-primary badge-pill">{{ $_SERVER['SERVER_SOFTWARE'] }}</label>
                    </div>
                    <div class="settings-item">Server Port 
                        <label class="badge badge-primary badge-pill">{{ $_SERVER['SERVER_PORT'] }}</label>
                    </div>
                    <div class="settings-item">Server Protocal
                        <label class="badge badge-primary badge-pill">{{  $_SERVER['SERVER_PROTOCOL'] }}</label>
                    </div>
                    <div class="settings-item">Server Name 
                        <label class="badge badge-primary badge-pill">{{ $_SERVER['SERVER_NAME'] }}</label>
                    </div>
                    <div class="settings-item">Last Login 
                        <label class="badge badge-primary badge-pill">{{ $_SERVER['REMOTE_ADDR'] }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END QUICK SIDEBAR-->
    <!-- CORE PLUGINS-->
    <script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/metisMenu/dist/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <!-- PAGE LEVEL PLUGINS-->
    @yield('scripts')
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script>
      @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
      @endif
      @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}")
      @endif
      @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}")
      @endif
      @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
      @endif
    </script>
</body>
</html>