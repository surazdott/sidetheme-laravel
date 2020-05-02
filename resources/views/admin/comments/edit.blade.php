@extends('layouts.admin')
@section('title') Edit Comment @endsection
@section('styles')
<link href="{{ asset('assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet"/>
@endsection
@section('contents')
<div class="comment-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Edit Comment</div>
		        </div>
		        <form action="{{ route('comment.update', ['id' => $comment->id]) }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Name</label>
			                <input class="form-control form-control-solid" name="name" type="text" placeholder="comment Name" value="{{ $comment->name }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Email</label>
			                <input class="form-control form-control-solid" name="email" type="text" placeholder="Email Address" value="{{ $comment->email }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Comment</label>
			                <textarea class="form-control form-control-solid" name="body" rows="5">{{ $comment->body }}</textarea>
			            </div>
			             <div class="form-group">
                            <label class="form-control-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="approved" {{ $comment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ $comment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="spam" {{ $comment->status == 'spam' ? 'selected' : '' }}>Spam</option>
                            </select>
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
@section('scripts')
<script src="{{ asset('assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script>
  if ($("#content").length) {
    $('#content').summernote({
      placeholder: 'Write comment content here...',
      airMode: false,
      height: 250,
      tabsize: 2
    });
  }
</script>
@endsection