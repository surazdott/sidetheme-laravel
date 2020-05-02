@extends('layouts.admin')
@section('title') Add Page @endsection
@section('styles')
<link href="{{ asset('assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet"/>
@endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Add Page</div>
		        </div>
		        <form action="{{ route('page.store') }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Name</label>
			                <input class="form-control form-control-solid" name="name" type="text" placeholder="Page Name" value="{{ old('name') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label> Slug <small>(If you leave it empty it will create slug automatically.)</small></label>
			                <input class="form-control form-control-solid" name="slug" type="text" placeholder="Page Slug" value="{{ old('slug') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Content</label>
			                <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Meta Title</label>
			                <input class="form-control form-control-solid" name="meta_title" type="text" placeholder="Meta Title" value="{{ old('meta_title') }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Meta Description</label>
			                <textarea class="form-control form-control-solid" name="meta_description" id="meta_description" rows="3" placeholder="Meta Description"></textarea>
			            </div>
			            <div class="form-group row">
                            <div class="col-3">Publish Page</div>
                            <div class="col-3">
                                <label class="ui-switch">
                                    <input type="checkbox" name="status" value="1">
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
@section('scripts')
<script src="{{ asset('assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script>
 	if ($("#content").length) {
        $('#content').summernote({
            placeholder: 'Write content body here...',
            airMode: false,
            height: 250,
            tabsize: 2,
            toolbar: [
                ['style', ['style']],
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'hr', 'video']],
                ['table', ['table']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                }
            }
        });
    }
</script>
@endsection