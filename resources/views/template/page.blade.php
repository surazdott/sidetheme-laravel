@extends('layouts.template')
@section('title') {{ $page->meta_title }} @endsection
@section('description') {{ $page->meta_description }} @endsection
@section('ogtitle') {{ $page->meta_title }} @endsection
@section('ogdesc') {{ $page->meta_description }} @endsection
@section('twitter_title') {{ $page->meta_title }} @endsection
@section('twitter_desc') {{ $page->meta_description }} @endsection
@section('contents')
<div class="container">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
    		<li class="breadcrumb-item" ><a href="{{ $settings->site_url }}">Home</a></li>
    	<li class="breadcrumb-item active" aria-current="page">{{ $page->name }}</li>
  		</ol>
	</nav>
	<h2 class="page-header">{{ $page->name }}</h2>
	<div class="row">
	    <div class="col-xl-12 mx-auto">
	    	<p class="page-text">{!! $page->content !!}</p>
	    </div>
	</div>
</div>
@endsection