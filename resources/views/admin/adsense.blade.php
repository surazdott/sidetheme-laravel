@extends('layouts.admin')
@section('title') Adsense @endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Adsense</div>
		        </div>
		        <form action="{{ route('adsense.update') }}" method="post">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			           <div class="form-group mb-4">
			                <label>Above Featured <small>(970×250)</small></label>
			                <textarea class="form-control form-control-solid" name="above_featured" rows="5">{{ $adsense->above_featured }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Latest <small>(970×250)</small></label>
			                <textarea class="form-control form-control-solid" name="above_latest" rows="5">{{ $adsense->above_latest }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Footer <small>(970×250)</small></label>
			                <textarea class="form-control form-control-solid" name="above_footer" rows="5">{{ $adsense->above_footer }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Image <small>(728×90)</small></label>
			                <textarea class="form-control form-control-solid" name="above_image" rows="5">{{ $adsense->above_image }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Description <small>(728×90)</small></label>
			                <textarea class="form-control form-control-solid" name="above_desc" rows="5">{{ $adsense->above_desc }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Below Description <small>(728×90)</small></label>
			                <textarea class="form-control form-control-solid" name="below_desc" rows="5">{{ $adsense->below_desc }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Details <small>(336×280)</small></label>
			                <textarea class="form-control form-control-solid" name="above_details" rows="5">{{ $adsense->above_details }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Downloads <small>(336×280)</small></label>
			                <textarea class="form-control form-control-solid" name="above_downloads" rows="5">{{ $adsense->above_downloads }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Above Tags <small>(336×280)</small></label>
			                <textarea class="form-control form-control-solid" name="above_tags" rows="5">{{ $adsense->above_tags }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Below Tags <small>(336×280)</small></label>
			                <textarea class="form-control form-control-solid" name="below_tags" rows="5">{{ $adsense->below_tags }}</textarea>
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