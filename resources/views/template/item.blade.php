@extends('layouts.template')
@section('title')
    @if(!$item->meta_title) 
        {{ $item->name }}
    @else
        {{ $item->meta_title }} 
    @endif
@endsection
@section('description')
    @if(!$item->meta_description) 
        {{ $item->short_description }}
    @else
        {{ $item->meta_description }} 
    @endif
@endsection
@section('ogtitle')
    @if(!$item->meta_title) 
        {{ $item->name }}
    @else
        {{ $item->meta_title }} 
    @endif
@endsection
@section('ogimage') {{ url($item->image) }} @endsection
@section('ogdesc')
    @if(!$item->meta_description) 
        {{ $item->short_desc }}
    @else
        {{ $item->meta_description }} 
    @endif
@endsection
@section('twitter_title')
    @if(!$item->meta_title) 
        {{ $item->name }}
    @else
        {{ $item->meta_title }} 
    @endif
@endsection
@section('twitter_image') {{ url($item->image) }} @endsection
@section('twitter_desc')
    @if(!$item->meta_description) 
        {{ $item->short_desc }}
    @else
        {{ $item->meta_description }} 
    @endif
@endsection
@section('contents')
<div class="container mt-90">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
    	   <li class="breadcrumb-item" ><a href="{{ $settings->site_url }}">Home</a></li>
            @if($item->category_id > 0)
                <li class="breadcrumb-item" >{{ $item->category->name }}</li>
            @endif
    	   <li class="breadcrumb-item active" aria-current="page">{{ $item->name }}</li>
  		</ol>
	</nav>
	<h1 class="item-header">{{ $item->name }}</h1>
	<div class="row">
    	<div class="col-lg-8">
    		<!-- Ad Above Image -->
            @if($adsense->above_image)
            	<div class="card card-outline-secondary my-4">
                	{!! $adsense->above_image !!}	
            	</div>
            @endif
        	<div class="card mt-4">
                @if(file_exists($item->image))
          		    <img class="single-image img-fluid" src="{{ url($item->image) }}" alt="{{ $item->name }}">
                @else
                    <img class="single-image img-fluid" src="{{ asset('assets/img/no-image.png') }}" alt="{{ $item->name }}">
                @endif
                @if(file_exists($item->file) or $item->download_link or $item->live_demo)
              		<div class="card-body">
                		<div id="outer">
                            @if($item->live_demo)
                                <div class="inner">
                                    <a href="{{ route('demo', ['slug' => $item->slug]) }}" target="_blank" class="btn btn-preview"><i class="fa fa-eye"></i> Live Preview</a>
                                </div>
                            @endif
                            @if(file_exists($item->file))
                                <div class="inner">
                                    <form action="{{ route('item.download', $item->slug) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-download">
                                            <i class="fa fa-download"></i> Download
                                            <input type="hidden" name="count" value="{{ $item->download }}">
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if($item->download_link)
                                <div class="inner">
                                    <form action="{{ route('item.download', $item->slug) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-download">
                                            <i class="fa fa-download"></i> Download
                                            <input type="hidden" name="count" value="{{ $item->download }}">
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
              		</div>
                @endif
        	</div>
        	<!-- Ad Above Description -->
            @if($adsense->above_desc)
            	<div class="card card-outline-secondary my-4">
                	{!! $adsense->above_desc !!}
            	</div>
            @endif
        	<div class="card card-outline-secondary my-4">
        		<div class="card-header description">
        			Description
        		</div>
        		<div class="card-body">
            		<p>{!! $item->description !!}</p>
          		</div>
        	</div>
        	<!-- Ad Below Description -->
            @if($adsense->below_desc)
            	<div class="card card-outline-secondary my-4">
                	{!! $adsense->below_desc !!}	
            	</div>
            @endif
        	<div class="card card-outline-secondary my-4">
        		<div class="card-header description">
        			Comments
        		</div>
        		<!-- Commnet Section -->
        		<div class="card-body">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey dude!</strong> {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                    @endforeach
                    <style type="text/css">
                        .alert {
                            font-size: 13px;
                        }
                    </style>
        			<form action="{{ route('comment.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Full name *</label>
                                <input type="text" class="form-control" name="name" placeholder="Full name">
                            </div>
                            <div class="col-sm-6">
                                <label >Email *</label>
                                <input type="text" class="form-control" name="email" placeholder="Email address">
                            </div>
                        </div>
				    	<div class="form-group">
				      		<textarea class="form-control" name="body" rows="3" placeholder="Write a message..."></textarea>
				    	</div>
                        <input type="hidden" name="item_id" value="{{ $item->id }}" />
				    	<button type="submit" class="btn btn-primary">Post</button>
				  	</form>
				  	<div class="pt-4">
                        @if($item->comments->count() == 1)
                            <h5 class="mb-5" style="font-size: 14px;">{{ $item->comments->count() }} Comment</h5>
                        @endif
                        @if($item->comments->count() > 1)
                            <h5 class="mb-5" style="font-size: 14px;">{{ $item->comments->count() }} Comments</h5>
                        @endif
                        <!-- Commnet Lists -->
                        <ul class="comment-list">
                            @foreach($comments as $comment)
                                <li class="comment">
                                    <div class="vcard">
                                        <img src="{{ asset('assets/img/user.jpg')}}" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h5>{{ $comment->name }}</h5>
                                        <div class="meta">{{ $comment->created_at->toDayDateTimeString() }}</div>
                                        <p style="font-size: 14px">{{ $comment->body }}</p>
                                        <p><a class="btn reply" id="replyButton{{ $comment->id }}">Reply</a></p>
                                        <form id="replyForm{{ $comment->id }}" style="display: none;" action="{{ route('comment.store') }}" method="post">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="inputFirstname">Full name *</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Full name">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inputLastname">Email *</label>
                                                    <input type="text" class="form-control" name="email" placeholder="Email address">
                                                </div>
                                            </div>
    	                                	<div class="form-group">
    								      		<textarea class="form-control" name="body" rows="2" placeholder="Write a message..."></textarea>
    								    	</div>
                                            <input type="hidden" name="item_id" value="{{ $item->id }}" />
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}"/>
    								    	<button type="submit" class="btn reply">Post</button>
    				                    </form><br>
                                    </div>
                                    @foreach($comment->replies as $reply)
                                        <ul class="children">
                                            <li class="comment">
                                                <div class="vcard">
                                                    <img src="{{ asset('assets/img/user.jpg')}}" alt="Image placeholder">
                                                </div>
                                                <div class="comment-body">
                                                    <h5>{{ $reply->name }}</h5>
                                                    <div class="meta">{{ $reply->created_at->toDayDateTimeString() }}</div>
                                                    <p>{{ $reply->body }}</p>         
                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                        <!-- Commnet Lists -->
                    </div>
				</div>
				<!-- Commnet Section -->
        	</div>
    	</div>
    	<!-- Ad Above Details -->
    	<div class="col-lg-4">
            @if($adsense->above_details)
        		<div class="list-group my-4">
    					{!! $adsense->above_details !!}
    				</ul>
            	</div>
            @endif
        	<div class="list-group my-4">
	          	<ul class="list-group">
        		<li href="#" class="list-group-item title">Item Details</li>
    				<li class="list-group-item list">
                        @if($item->author)
                            <p><b>Author :</b> {{ $item->author }}</p>
                        @endif
                        @if($item->released)
    				        <p><b>Created :</b> {{ \Carbon\Carbon::parse($item->released)->toFormattedDateString()  }}</p>
                        @endif
                        @if($item->updated_at)
    				        <p><b>Last Updated :</b> {{ \Carbon\Carbon::parse($item->updated_at)->toFormattedDateString()  }}</p>
                        @endif
                        @if($item->file_size)
    				        <p><b>File Size :</b> <a class="badge badge-success" style="padding-top: 5px; padding-bottom: 5px; padding-right: 8px; padding-left: 8px; color: #fff">{{ $item->file_size }}</a></p>
                        @endif
                        @if($item->version)
    				        <p><b>Version :</b> {{ $item->version }}</p>
                        @endif
                        @if($item->compatible)
                            <p><b>Compatible :</b>
                                <a class="badge badge-primary" style="padding-top: 5px; padding-bottom: 5px; padding-right: 8px; padding-left: 8px; color: #fff"> {{ $item->compatible }}</a>
                            </p>
                        @endif
                        @if($item->framework)
    				        <p><b>Framework :</b> {{ $item->framework }}</p>
                        @endif
                        @if($item->files_included)
    				        <p><b>Files Included :</b> {{ $item->files_included }}</p>
                        @endif
    				    <p><b>Category :</b> 
                            @if($item->category_id > 0)
                                <a class="badge badge-secondary" style="padding-top: 5px; padding-bottom: 5px; padding-right: 8px; padding-left: 8px; color: #fff"> {{ $item->category->name }}</a>
                            @endif
                        </p>
                        @if($item->compatible_browser)
    				        <p><b>Browser :</b> {{ $item->compatible_browser }}</p>
                        @endif
                        @if($item->documentation)
    				        <p><b>Documentation :</b> <a href="{{ $item->documentation }}" target="blank" class="badge badge-success" style="padding-top: 8px; padding-bottom: 8px; padding-right: 15px; padding-left: 15px;"> Click to View</a></p>
                        @endif
    				</li>
                    <style type="text/css">
                        .list b {
                            margin-right: 10px;
                        }
                    </style>
				</li>
				</ul>
        	</div>
        	<!-- Ad Above Downloads -->
            @if($adsense->above_downloads)
            	<div class="list-group my-4">
    				  {!! $adsense->above_downloads !!}
    				</ul>
            	</div>
            @endif
            @if($item->download)
                @if($item->download <= 1)
        	       <h5 class="list-group-item download-count"><i class="fa fa-download"></i> {{ number_format($item->download) }} download</h5>
                @else
                    <h5 class="list-group-item download-count"><i class="fa fa-download"></i> {{ number_format($item->download) }} downloads</h5>
                @endif
            @else
                <h5 class="list-group-item download-count"><i class="fa fa-download"></i> 0 download</h5>
            @endif
        	<!-- Ad Above Tags -->
            @if($adsense->above_tags)
            	<div class="list-group my-4">
    				  {!! $adsense->above_tags !!}
    				</ul>
            	</div>
            @endif
        	<div class="list-group my-4">
	          	<ul class="list-group">
        		<li href="#" class="list-group-item title">Tags</li>
				<li class="list-group-item list" style="font-weight: normal;">
				    <p>
                        @foreach($item->tags as $tag)
                            <a href="{{ route('tag', ['slug' => $tag->slug]) }}">{{ Str::lower($tag->name) }}</a>,
                        @endforeach
				    </p>
				</li>
				  </li>
				</ul>
        	</div>
        	<!-- Ad Below Tags -->
            @if($adsense->below_tags)
            	<div class="list-group my-4">
    				  {!! $adsense->below_tags !!}
    				</ul>
            	</div>
            @endif
    	</div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    @foreach($comments as $comment)
	$(document).ready(function() {
	  $("#replyButton{{ $comment->id }}").click(function() {
	    $("#replyForm{{ $comment->id }}").toggle();
	  });
	});
    @endforeach
</script>
@endsection