@extends('layouts.admin')
@section('contents')
<div class="page-content fade-in-up">
    @if(Auth::user()->role == 'admin')
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-success">
                    <div class="card-body">
                        <h2 class="text-white">{{ $items_count }} <i class="ti-shopping-cart float-right"></i></h2>
                        <div>ITMES</div>
                        <div class="text-white mt-1">
                            <a href="{{ route('items') }}">
                                <span>View Items</span>
                                <span class="ml-2"><i class="fa fa-caret-up text-success"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="progress mb-2 widget-dark-progress">
                        <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h2 class="text-white">{{ $category_count }} <i class="ti-folder float-right"></i></h2>
                        <div>CATEGORY</div>
                        <div class="text-white mt-1">
                            <a href="{{ route('categories') }}">
                                <span>View Categories</span>
                                <span class="ml-2"><i class="fa fa-caret-up text-success"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="progress mb-2 widget-dark-progress">
                        <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-danger">
                    <div class="card-body">
                        <h2 class="text-white">{{ $users_count }} <i class="ti-user float-right"></i></h2>
                        <div>ALL USERS</div>
                        <div class="text-white mt-1">
                            <a href="{{ route('users') }}">
                                <span>View Users</span>
                                <span class="ml-2"><i class="fa fa-caret-up text-success"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="progress mb-2 widget-dark-progress">
                        <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <h2>{{ $comments_count }} <i class="ti-comment float-right"></i></h2>
                        <div>COMMENTS</div>
                        <div class="text-white mt-1">
                            <a href="{{ route('comments') }}">
                                <span>View Comments</span>
                                <span class="ml-2"><i class="fa fa-caret-up text-success"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="progress mb-2 widget-dark-progress">
                        <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ibox ibox-fullheight">
                    <div class="ibox-head">
                        <div class="ibox-title">Latest Items</div>
                        <div class="ibox-tools">
                            <a class="dropdown-toggle" data-toggle="dropdown"><i class="ti-more-alt"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('item.create') }}" class="dropdown-item"><i class="ti-pencil"></i>Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <ul class="media-list media-list-divider">
                            @foreach($items as $item)
                            <li class="media">
                                <a class="media-img pr-4" href="javascript:;">
                                    @if(file_exists($item->image))
                                    <img src="{{ url($item->image)}}" alt="{{ $item->name }}" width="120">
                                    @else
                                    <img src="{{ asset('assets/img/no-image.png')}}" alt="{{ $item->name }}" width="120">
                                    @endif
                                </a>
                                <div class="media-body d-flex">
                                    <div class="flex-1">
                                        <h5 class="media-heading">
                                            <a>{{ $item->name }}</a>
                                        </h5>
                                        <p class="font-13 text-light">{{ Str::limit($item->short_description, 250) }}</p>
                                        <div class="font-13">
                                            <span class="mr-4">Created:
                                                <a class="text-success" href="javascript:;">{{ $item->created_at->diffForHumans() }}</a>
                                            </span>
                                            <span class="text-muted mr-4"><i class="fa fa-heart mr-2"></i>56</span>
                                            <span class="text-muted"><i class="fa fa-comment mr-2"></i>124</span>
                                        </div>
                                    </div>
                                    <div class="text-right ml-3">
                                        @if($item->download == null)
                                        <h3 class="mb-1 font-strong text-primary">0</h3>
                                        @else
                                        <h3 class="mb-1 font-strong text-primary">{{ $item->download }}</h3>
                                        @endif
                                        <div class="text-muted">Download</div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="alert alert-warning"><strong>Warning!</strong><br>Your have no previllage to access this page.</div>
    @endif
</div>
@endsection
            