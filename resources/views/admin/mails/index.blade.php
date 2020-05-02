@extends('layouts.admin')
@section('title') Send Mail @endsection
@section('styles')
<link href="{{ asset('assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet"/>
@endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Send Mail</div>
		        </div>
		        <form action="{{ route('mail.send') }}" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
		        		<div class="form-group mb-4">
                            <label>From</label>
                            <select class="form-control form-control-solid">
                                <option value="">Default</option>
                            </select>
                        </div>
		        		<div class="form-group mb-4">
                            <label>Send To</label>
                            <select class="form-control form-control-solid" name="to">
                                <option value="users">Users</option>
                                <option value="subscribers">Subscriber</option> 
                            </select>
                        </div>
			            <div class="form-group mb-4">
			                <label>Subject</label>
			                <input class="form-control form-control-solid" name="subject" type="text" placeholder="Subject" value="">
			            </div>
			             <div class="form-group mb-4">
			                <label>Message</label>
			                <textarea class="form-control" name="message" id="message"></textarea>
			            </div>
			            <div class="ibox-footer">
		                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancel</a>
		                    <button class="btn btn-primary mr-2" type="submit">Send</button>
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
  	if ($("#message").length) {
        $('#message').summernote({
            placeholder: 'Write message...',
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