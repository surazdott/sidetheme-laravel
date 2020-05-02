@extends('layouts.admin')
@section('title') Add Category @endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Add Category</div>
		        </div>
		        <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Name</label>
			                <input class="form-control form-control-solid" name="name" type="text" placeholder="Category Name" value="{{ old('name') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label> Slug <small>(If you leave it empty it will create slug automatically.)</small></label>
			                <input class="form-control form-control-solid" name="slug" type="text" placeholder="Slug for SEO" value="{{ old('name') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Parent Category</label>
			                <select class="form-control form-control-solid" name="parent_id">
			                	<option value="">-- None --</option>
			                	@foreach($parentCategories as $parentCategory)
			                    <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
			                    @endforeach
			                </select>
			            </div>
			            <div class="form-group mb-4">
			                <label>Order ID</label>
			                <input class="form-control form-control-solid" name="order_id" type="number" min="1" max="50" placeholder="Order ID Number" value="{{ old('name') }}">
			            </div>
			            <div class="form-group mb-4">
                            <label>Meta Title</label>
                            <input class="form-control form-control-solid" name="meta_title" type="text" placeholder="Meta Title">
                        </div>
                        <div class="form-group mb-4">
                            <label>Meta Description</label>
                            <textarea class="form-control form-control-solid" name="meta_description" id="meta_description" rows="3" placeholder="Meta Description"></textarea>
                        </div>
			            <div class="ibox-footer">
		                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
		                    <button class="btn btn-primary mr-2" type="submit">Submit</button>
		                </div>
			        </div>
			    </form>
		    </div>
		</div>
	</div>
</div>
@endsection