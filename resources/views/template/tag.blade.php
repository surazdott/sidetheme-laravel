@extends('layouts.template')
@section('title')
    @if(!$tag->meta_title) 
        {{ $tag->name }}
    @else
        {{ $tag->meta_title }} 
    @endif
@endsection
@section('description')
    @if(!$tag->meta_description) 
        {{ __('') }}
    @else
        {{ $tag->meta_description }} 
    @endif
@endsection
@section('ogtitle')
    @if(!$tag->meta_title) 
        {{ $tag->name }}
    @else
        {{ $tag->meta_title }} 
    @endif
@endsection
@section('ogdesc')
    @if(!$tag->meta_description) 
        {{ __('') }}
    @else
        {{ $tag->meta_description }} 
    @endif
@endsection
@section('twitter_title')
    @if(!$tag->meta_title) 
        {{ $tag->name }}
    @else
        {{ $tag->meta_title }} 
    @endif
@endsection
@section('twitter_desc')
    @if(!$tag->meta_description) 
        {{ __('') }}
    @else
        {{ $tag->meta_description }} 
    @endif
@endsection
@section('contents')
<!-- Featured Themes -->
<div class="container mt-90">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
    	   <li class="breadcrumb-item" ><a href="{{ $settings->site_url }}">Home</a></li>
           <li class="breadcrumb-item active" aria-current="page">Tag</li>
    	   <li class="breadcrumb-item active" aria-current="page">{{ $tag->name }}</li>
  		</ol>
	</nav>
	<h4 class="text-left" style="font-size: 24px">{{ $tag->name }}</h4>
	@if($items->count() > 0)
        <div class="row mb-5">
            @foreach($items as $item)
                @if($item->status == 1)
                    <div class="col-md-3 card-margin">
                        <div class="card card-height">
                            <a href="{{ route('item', ['slug' => $item->slug]) }}">
                                @if(file_exists($item->image))
                                    <img src="{{ url($item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                                @else
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="card-img-top" alt="{{ $item->name }}">
                                @endif
                            </a>
                            <div class="card-body">
                                <a href="{{ route('item', ['slug' => $item->slug]) }}">
                                    <h5 class="card-title">{{ Str::limit($item->name, 40) }}</h5>
                                </a>
                                <p>{{ Str::limit($item->short_description, 45) }}</p>
                                <a href="{{ route('item', ['slug' => $item->slug]) }}" class="btn btn-sm btn-primary">Download</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <p style="margin-top: 50px; text-align: center; font-size: 24px;">Sorry ! There is no any items listed.</p>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="row mb-5">
            <div class="col-sm-12">
                <p style="margin-top: 50px; text-align: center; font-size: 24px;">Sorry ! There is no any items listed.</p>
            </div>
        </div>
    @endif
	<!-- Pagination -->
	<ul class="pagination justify-content-center">
    	{{ $items->links() }}
  	</ul>
</div>
@endsection
