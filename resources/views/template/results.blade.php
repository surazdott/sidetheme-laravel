@extends('layouts.template')
@section('title') You searched for  : {{ $query }} @endsection
@section('description') You searched for : {{ $query }} @endsection
@section('ogtitle') You searched for : {{ $query }} @endsection
@section('ogdesc') You searched for : {{ $query }} @endsection
@section('twitter_title') You searched for : {{ $query }} @endsection
@section('twitter_desc') You searched for : {{ $query }} @endsection
@section('contents')
<!-- Featured Themes -->
<div class="container mt-90">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
    	   <li class="breadcrumb-item" ><a href="{{ $settings->site_url }}">Home</a></li>
    	   <li class="breadcrumb-item active" aria-current="page">{{ $query }}</li>
  		</ol>
	</nav>
	<h4 class="text-left" style="font-size: 24px">Search : {{ $query }}</h4>
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
                        <p style="margin-top: 50px; text-align: center; font-size: 22px;">Sorry! but nothing matched your search criteria. Please try again with some other keywords.</p>
                    </div>
                @endif
    		@endforeach
    	</div>
    @else
        <div class="row mb-5">
            <div class="col-sm-12">
                <p style="margin-top: 50px; text-align: center; font-size: 22px;">Sorry! but nothing matched your search criteria. Please try again with some other keywords.</p>
            </div>
        </div>
    @endif
	<!-- Pagination -->
	<ul class="pagination justify-content-center">
    	{{ $items->appends(Request::only('query'))->links() }}
  	</ul>
</div>
@endsection