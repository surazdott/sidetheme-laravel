@extends('layouts.admin')
@section('title') Categories @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection

@section('contents')
<div class="page-content fade-in-up">
  <div class="row">
    <div class="col-xl-12">
      <div class="ibox">
          <div class="ibox-head">
              <div class="ibox-title">List Categories</div>
              <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Category</a>
          </div>
          <div class="ibox-body">
              <table class="table" id="datatable">
                <thead class="thead-default">
                  <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent Category</th>
                    <th>Order ID</th>
                    <th>Modified</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($categories->count() > 0 )
                      @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                              @if($category->parent_id == null)
                                <span class="badge badge-success badge-pill">Parent Category</span>
                              @else
                                <span class="badge badge-primary badge-pill">{{ $category->parent->name }}</span>
                              @endif
                            </td>
                            <td>{{ $category->order_id }}</td>
                            <td>
                              @if($category->updated_at)
                                {{ $category->updated_at->toFormattedDateString() }}
                              @else
                                {{ $category->created_at->toFormattedDateString() }}
                              @endif
                            </td>
                            <td>
                              <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                              <button data-toggle="modal" onclick="deleteData({{$category->id}})" data-target="#delete-category" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                          <td colspan="6" class="text-center">No categories available in table</td>
                      </tr>
                    @endif
                </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
@foreach($categories as $category)
  <div class="modal fade" id="delete-category" aria-labelledby="delete-category" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form class="modal-content" action="" id="deleteForm">
        @csrf
        <div class="modal-header p-4">
          <h5 class="modal-title">Delete ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <p>Are your sure you want to delete this category? </p>
        </div>
        <div class="modal-footer justify-content-start">
          <button type="button" class="btn btn-secondary btn-rounded mr-3" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          <button type="submit" class="btn btn-danger btn-rounded mr-3" data-dismiss="modal" onclick="formSubmit()"><i class="fa fa-trash"></i> Delete</button>
        </div>
      </form>
    </div>
  </div>
@endforeach
@endsection
@section('scripts')
  <script src="{{ asset('assets/vendors/dataTables/datatables.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatable').DataTable();
  } );
  </script>
  <script type="text/javascript">
    function deleteData(id)
    {
      var id = id;
      var url = '{{ route("category.delete", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
      $("#deleteForm").submit();
    }
  </script>
@endsection