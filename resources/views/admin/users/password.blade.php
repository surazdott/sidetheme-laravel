@extends('layouts.admin')
@section('title') Change Password @endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Change Password</div>
		        </div>
		        <form action="{{ route('password.update') }}" method="post">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Old Password</label>
			                <input class="form-control form-control-solid" name="old_password" type="text" placeholder="Enter Old Password" value="">
			            </div>
			            <div class="form-group mb-4">
			                <label>New Password</label>
			                <input class="form-control form-control-solid" name="password" id="password" type="text" placeholder="Enter New Password" value="">
			            </div>
			            <div class="form-group mb-4">
			                <label>Confirm Password</label>
			                <input class="form-control form-control-solid" name="confirm_password" id="confirm_password" type="text" placeholder="Confirm Password" value="">
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