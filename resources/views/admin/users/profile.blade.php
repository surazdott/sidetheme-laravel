@extends('layouts.admin')
@section('title') Manage Profile @endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title"> Manage Profile </div>
		        </div>
		        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Name</label>
			                <input class="form-control form-control-solid" name="name" type="text" placeholder="You Full Name" value="{{ $user->name }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Profile Picture</label>
			                <input class="form-control form-control-solid" name="avatar" type="file" value="{{ old('') }}">
			            </div>

			            <div class="ibox-footer">
		                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
		                    <button class="btn btn-primary mr-2" type="submit">Update</button>
		                </div>
			        </div>
			    </form>
		    </div>
		</div>
	</div>
</div>
@endsection