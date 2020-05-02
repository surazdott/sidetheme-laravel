@extends('layouts.admin')
@section('title') Tags @endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
	    <div class="col-md-6">
	        <div class="ibox">
	            <div class="ibox-head">
	                <div class="ibox-title">Add Tag</div>
	            </div>
	            <form class="form-info" action="{{ route('tag.update', ['id' => $tag->id]) }}" method="post">
	            	@csrf
	                <div class="ibox-body">
	            	@include('admin.includes.error')
	                    <div class="form-group mb-4">
	                        <label>Name</label>
	                        <input class="form-control form-control-solid" type="text" name="name" placeholder="Name" value="{{ $tag->name }}">
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Slug</label>
	                        <input class="form-control form-control-solid"  type="text" name="slug" placeholder="Slug" value="{{ $tag->slug }}">
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Meta Title</label>
	                        <input class="form-control form-control-solid" type="text" name="meta_title" placeholder="Meta Title" value="{{ $tag->meta_title }}">
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Meta Description</label>
	                        <textarea class="form-control form-control-solid" name="meta_description" rows="3" placeholder="Meta Description">{{ $tag->meta_description }}</textarea>
	                    </div>
	                </div>
	                <div class="ibox-footer">
	                    <button class="btn btn-secondary" type="reset">Cancel</button>
	                    <button class="btn btn-primary mr-2" type="submit">Submit</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
@endsection