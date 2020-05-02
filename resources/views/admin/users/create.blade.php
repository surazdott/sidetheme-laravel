@extends('layouts.admin')
@section('title') Add User @endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title"> Add User </div>
		        </div>
		        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Name</label>
			                <input class="form-control form-control-solid" name="name" type="text" placeholder="You Full Name" value="{{ old('name') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Email</label>
			                <input class="form-control form-control-solid" name="email" type="email" placeholder="Email Address" value="{{ old('email') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Password</label>
			                <input class="form-control form-control-solid" name="password" type="text" placeholder="Password" value="{{ old('password') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Profile Picture</label>
			                <input class="form-control form-control-solid" name="avatar" type="file" value="{{ old('') }}">
			            </div>
			            <div class="form-group">
                            <label class="form-control-label">User Type</label>
                            <select class="form-control form-control-solid" name="role">
                                <option value="admin">Admin</option>
                                <option value="user" selected>User</option>
                            </select>
                        </div>
			            <div class="form-group row">
                            <div class="col-3">User Status</div>
                            <div class="col-3">
                                <label class="ui-switch">
                                    <input type="checkbox" name="status" value="1" checked>
                                    <span></span>
                                </label>
                            </div>
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