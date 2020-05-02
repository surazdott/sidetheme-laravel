@extends('layouts.template')
@section('title') {{ __('Contact Us') }} @endsection
@section('description') {{ __('Need to get in touch? No problem! You can use the contact form below to send us a message.') }} @endsection
@section('ogtitle') {{ __('Contact Us') }} @endsection
@section('ogdesc') {{ __('Need to get in touch? No problem! You can use the contact form below to send us a message.') }} @endsection
@section('twitter_title') {{ __('Contact Us') }} @endsection
@section('twitter_desc') {{ __('Need to get in touch? No problem! You can use the contact form below to send us a message.') }} @endsection
@section('contents')
<div class="container">
    <div class="col-sm-8">
    	<nav aria-label="breadcrumb">
    		<ol class="breadcrumb">
        		<li class="breadcrumb-item" ><a href="{{ $settings->site_url }}">Home</a></li>
        	<li class="breadcrumb-item active" aria-current="page">{{ __('Contact Us')}}</li>
      		</ol>
    	</nav>
    </div>
    <div class="col-sm-8">
	   <h2 class="page-header">Contact Us</h2>
	   <p style="font-size: 14px;">Need to get in touch? No problem! You can use the contact form below to send us a message.</p>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 15px;">
                <strong>Success! </strong>{{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @error('email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 15px;">
                <strong>Warning!</strong> Please fill up the required fields to send a message.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @enderror
        <form action="{{ route('message.send') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Name : *</label>
                <input type="text" class="form-control" id="name" placeholder="Full Name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email : *</label>
                <input type="email" class="form-control" id="email" placeholder="Email Address" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Subject : *</label>
                <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
            </div>
            <div class="form-group">
                <label for="pwd">Message : *</label>
                <textarea class="form-control" name="message" rows="7" placeholder="Write a message..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>
@endsection