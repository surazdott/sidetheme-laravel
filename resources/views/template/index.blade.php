@extends('layouts.template')
@section('contents')
<header>
	<!-- Search Form -->
	<section class="header-action text-white text-center">
	    <div class="overlay"></div>
	    <div class="container">
	      <div class="row">
	        <div class="col-xl-12 mx-auto">
	          <h2 class="mb-4 header">Download Free Themes and Templates</h2>
	        </div>
	        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
	        	<form method="get" action="{{ route('results') }}">
		            <div class="form-row">
		            	<div class="col-8 col-md-9 mb-2 mb-md-0">
		                	<input type="text" class="form-control form-control-lg" name="query" placeholder="Search...">
		              	</div>
		              </style>
		            	<div class="col-4 col-md-3">
		                	<button type="submit" class="btn btn-block btn-lg btn-success">Search</button>
		              	</div>
		            </div>
	         	</form>
	        </div>
	      </div>
	    </div>
	  </section>
</header>
<!-- Ad Above Featured Themes -->
@if($adsense->above_featured)
<div class="container">
	<div class="row mb-5">
		<div class="col-md-12 card-margin">
			<div class="card">
				{!! $adsense->above_featured !!}
			</div>
		</div>
	</div>
</div>
@endif
<!-- Featured Themes -->
<div class="container">
	<h4 class="text-left">Featured Themes</h4>
	<div class="row mb-5">
		@foreach($featured as $featured_item)
		<div class="col-md-3 card-margin">
			<div class="card card-height">
				<a href="{{ route('item', ['slug' => $featured_item->slug]) }}">
					<span class="item-badge">{{ $featured_item->category->name }}</span>
					@if(file_exists($featured_item->image))
						<img src="{{ url($featured_item->image) }}" class="card-img-top" alt="{{ $featured_item->name }}">
					@else
						<img src="{{ asset('assets/img/no-image.png') }}" class="card-img-top" alt="{{ $featured_item->name }}">
					@endif
				</a>
				<div class="card-body">
					<a href="{{ route('item', ['slug' => $featured_item->slug]) }}">
						<h5 class="card-title">{{ Str::limit($featured_item->name, 40) }}</h5>
					</a>
					<p>{{ Str::limit($featured_item->short_description, 45) }}</p>
					<a href="{{ route('item', ['slug' => $featured_item->slug]) }}" class="btn btn-sm btn-primary">Download</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
<!-- Ad Above Lates Themes -->
@if($adsense->above_latest)
<div class="container">
	<div class="row mb-5">
		<div class="col-md-12 card-margin">
			<div class="card">
				{!! $adsense->above_latest !!}
			</div>
		</div>
	</div>
</div>
@endif
<!-- Latest Themes -->
<div class="container">
	<h4 class="text-left">Latest Themes</h4>
	<div class="row mb-5">
		@foreach($latest as $latest_item)
		<div class="col-md-3 card-margin">
			<div class="card card-height">
				<a href="{{ route('item', ['slug' => $latest_item->slug]) }}">
					<span class="item-badge">{{ $latest_item->category->name }}</span>
					@if(file_exists($latest_item->image))
						<img src="{{ url($latest_item->image) }}" class="card-img-top" alt="{{ $latest_item->name }}">
					@else
						<img src="{{ asset('assets/img/no-image.png') }}" class="card-img-top" alt="{{ $latest_item->name }}">
					@endif
				</a>
				<div class="card-body">
					<a href="{{ route('item', ['slug' => $latest_item->slug]) }}">
						<h5 class="card-title">{{ Str::limit($latest_item->name, 40) }}</h5>
					</a>
					<p>{{ Str::limit($latest_item->short_description, 45) }}</p>
					<a href="{{ route('item', ['slug' => $latest_item->slug]) }}" class="btn btn-sm btn-primary">Download</a>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
<!-- Ad Abobe Footer Themes -->
@if($adsense->above_footer)
<div class="container">
	<div class="row mb-5">
		<div class="col-md-12 card-margin">
			<div class="card">
				{!! $adsense->above_footer !!}
			</div>
		</div>
	</div>
</div>
@endif
@endsection
