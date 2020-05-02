@extends('layouts.admin')
@section('title') Tags @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
	    <div class="col-md-5">
	        <div class="ibox">
	            <div class="ibox-head">
	                <div class="ibox-title">Add Tag</div>
	            </div>
	            <form class="form-info" action="{{ route('tag.store') }}" method="post">
	            	@csrf
	                <div class="ibox-body">
	            	@include('admin.includes.error')
	                    <div class="form-group mb-4">
	                        <label>Name</label>
	                        <input class="form-control form-control-solid" type="text" name="name" placeholder="Name">
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Slug</label>
	                        <input class="form-control form-control-solid" type="text" name="slug" placeholder="Slug">
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Meta Title</label>
	                        <input class="form-control form-control-solid" type="text" name="meta_title" placeholder="Meta Title">
	                    </div>
	                    <div class="form-group mb-4">
	                        <label>Meta Description</label>
	                        <textarea class="form-control form-control-solid" name="meta_description" rows="3" placeholder="Meta Description"></textarea>
	                    </div>
	                </div>
	                <div class="ibox-footer">
	                    <button class="btn btn-secondary" type="reset">Cancel</button>
	                    <button class="btn btn-primary mr-2" type="submit">Submit</button>
	                </div>
	            </form>
	        </div>
	    </div>
	    <div class="col-md-7">
	        <div class="ibox">
	        	<form action="{{ route('tag.delete') }}" method="post">
	        		@csrf
		            <div class="ibox-head">
		                <div class="ibox-title">List Tags</div>
		                <button type="submit" onclick="return confirm('Are you sure you want to delete this tag?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
		            </div>
		            <div class="ibox-body">
		            	<table class="table" id="datatable">
			                <thead class="thead-default">
			                  <tr>
			                  	<th>
				                  	<div class="flexbox-b">
			                            <label class="checkbox checkbox-primary check-single pt-1">
			                                <input type="checkbox" id="select-all" >
			                                <span class="input-span"></span>
			                            </label>
			                    	</div>
	                           	</th>
			                    <th>S.N</th>
			                    <th>Name</th>
			                    <th>Slug</th>
			                    <th>Modified</th>
			                    <th>Action</th>
			                  </tr>
			                </thead>
			                <tbody>
			                    @if($tags->count() > 0 )
			                      @foreach($tags as $tag)
			                        <tr>
			                        	<td class="check-cell rowlink-skip">
	                                        <label class="checkbox checkbox-primary check-single">
	                                        	<input class="check" name="id[]" type="checkbox" value="{{ $tag->id }}">
	                                            <span class="input-span"></span>
	                                        </label>
	                                    </td>
			                            <td>{{ $loop->index+1 }}</td>
			                            <td>{{ $tag->name }}</td>
			                            <td>{{ $tag->slug }}</td>
			                            <td>
			                            	@if(empty($tag->updated_at))
			                            	{{ $tag->created_at->toFormattedDateString() }}
			                            	@else
			                            	{{ $tag->updated_at->toFormattedDateString() }}
			                            	@endif
			                            </td>
			                            <td>
			                              <a href="{{ route('tag.edit', ['id' => $tag->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
			                          </td>
			                        </tr>
			                      @endforeach
			                    @else
			                      <tr>
			                          <td colspan="6" class="text-center">No tags available in table</td>
			                      </tr>
			                    @endif
			                </tbody>
		            	</table>
		        	</div>
		       	</form>
	        </div>
	    </div>
	</div>
</div>
@endsection
@section('scripts')
  <script src="{{ asset('assets/vendors/dataTables/datatables.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatable').DataTable();
  } );
  </script>
  <script type="text/javascript">
	  	$('#select-all').click(function(event) {   
	    if(this.checked) {
	        // Iterate each checkbox
	        $(':checkbox').each(function() {
	            this.checked = true;                        
	        });
	    } else {
	        $(':checkbox').each(function() {
	            this.checked = false;                       
	        });
	    }
	});
  </script>
@endsection