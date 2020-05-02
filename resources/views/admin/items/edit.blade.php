@extends('layouts.admin')
@section('title') Edit Item @endsection
@section('styles')
<link href="{{ asset('assets/vendors/summernote/dist/summernote.css')}}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('contents')
<div class="page-content fade-in-up">
	<div class="row">
		<div class="col-md-12">
		    <div class="ibox">
		        <div class="ibox-head">
		            <div class="ibox-title">Edit Category</div>
		        </div>
		        <form action="{{ route('item.update', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
		        	@csrf
			        <div class="ibox-body">
		        	@include('admin.includes.error')
			            <div class="form-group mb-4">
			                <label>Name</label>
			                <input class="form-control" name="name" type="text" placeholder="Item Name" value="{{ $item->name }}">
			            </div>
			            <div class="form-group mb-4">
			                <label>Slug<small> (http://www.example.com/slug)</small></label>
			                <input class="form-control" name="slug" type="text" placeholder="Slug" value="{{ $item->slug }}">
			            </div>
                        <div class="form-group mb-4">
                            <label>Short Description</label>
                            <textarea class="form-control" name="short_description" rows="5" placeholder="Write short description..">{{ $item->short_description }}</textarea>
                        </div>
			            <div class="form-group mb-4">
			                <label> Description</label>
			                <textarea class="form-control" name="description" id="description" rows="3">{{ $item->description }}</textarea>
			            </div>
			            <div class="form-group mb-4">
			                <label>Category</label>
			                <select class="form-control categories" name="category_id">
			                	<option value="" selected>-- None --</option>
			                	@foreach($categories as $category)
			                	@if($category->parent_id == null))
			                		<option value="{{ $category['id'] }}"
                                    @if($item->category_id != null)
                                    @if($category['id'] == $item->category['id']) selected 
                                    @endif @endif>{{ $category->name }}</option>
			                		@foreach($category->children as $child)
			                			<option value="{{ $child['id'] }}" 
                                        @if($item->category_id != null)
                                        @if($child['id'] == $item->category['id']) selected 
                                    @endif @endif>--{{ $child->name }}</option>
			                		@endforeach
			                	@endif
			                	@endforeach
			                </select>
			            </div>
                        <div class="form-group">
                            <label class="form-control-label">Choose Tags</label>
                            <select class="form-control tags" multiple="" name="tags[]">
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    @foreach($item->tags as $item_tag) @if($tag->id == $item_tag->id) selected @endif @endforeach>{{ $tag->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
			            <div class="row">
                            <div class="col-sm-6 form-group mb-4">
                                <label>Upload Image<small> (.png .jepg .jpg .gif)</small></label>
                                <input class="form-control file" type="file" accept=".png,.jpg,.jpeg,.gif" name="image" value="{{ old('image') }}">
                            </div>
                            <div class="col-sm-6 form-group mb-4">
                                <label>Upload File<small> (.zip)</small></label>
                                <input class="form-control" type="file" accept=".zip" name="file" value="{{ old('file') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group mb-4">
                                <label>Download Link <small> (Paste the downlaod link instead of file.)</small></label>
                                <input class="form-control" name="download_link" type="text" placeholder="Item Download Link" value="{{ $item->download_link }}">
                            </div>
                            <div class="col-sm-6 form-group mb-4">
                                <label>Compatible</label>
                                <input class="form-control" type="text" placeholder="Compatible With" name="compatible" value="{{ $item->compatible }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group mb-4">
                                <label>Released<small> (dd-mm-yyyy)</small></label>
                                <input class="form-control date" placeholder="Released Date" name="released" value="{{ $item->released }}" autocomplete="off">
                            </div>
                            <div class="col-sm-6 form-group mb-4">
                                <label>Author</label>
                                <input class="form-control" placeholder="Author" name="author" value="{{ $item->author }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group mb-4">
                                <label>Version</label>
                                <input class="form-control" type="text" placeholder="Latest Version" name="version" value="{{ $item->version }}">
                            </div>
                            <div class="col-sm-6 form-group mb-4">
                                <label>Framework</label>
                                <input class="form-control" type="text" placeholder="Software Framework" name="framework" value="{{ $item->framework }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group mb-4">
                                <label>Files Included</label>
                                <input class="form-control" type="text" placeholder="File Included" name="files_included" value="{{ $item->files_included }}">
                            </div>
                            <div class="col-sm-6 form-group mb-4">
                                <label>Documentation</label>
                                <input class="form-control" type="text" placeholder="Documentation" name="documentation" value="{{ $item->documentation }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group mb-4">
                                <label>Compatible</label>
                                <input class="form-control" type="text" placeholder="Browser Compatible" name="compatible_browser" value="{{ $item->compatible_browser }}">
                            </div>
                            <div class="col-sm-6 form-group mb-4">
                                <label>Live Demo<small> (http://sitename.com/demo)</small></label>
                                <input class="form-control" type="text" placeholder="Live Demo Url" name="live_demo" value="{{ $item->live_demo }}">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label>Meta Title</label>
                            <input class="form-control" name="meta_title" type="text" placeholder="Meta Title" value="{{ $item->meta_title }}">
                        </div>
                        <div class="form-group mb-4">
                            <label>Meta Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="3" placeholder="Meta Description">{{ $item->meta_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </div>
			            <div class="ibox-footer">
		                    <a href="{{URL::previous()}}" class="btn btn-secondary">Cancel</a>
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
<script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('assets/vendors/summernote/dist/summernote.min.js')}}"></script>
<script>
    if ($("#description").length) {
        $('#description').summernote({
            placeholder: 'Write description here...',
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
<script type="text/javascript">
    $('.date').datepicker({
       format: 'dd-mm-yyyy'
    });
</script>
<script type="text/javascript">
	$(document).ready(function() {
    	$('.categories').select2();
	});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tags').select2();
    });
</script>
@endsection