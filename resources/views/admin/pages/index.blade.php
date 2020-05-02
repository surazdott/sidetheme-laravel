@extends('layouts.admin')
@section('title') Pages @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection
@section('contents')
<div class="page-content fade-in-up">
  <div class="row">
    <div class="col-xl-12">
      <div class="ibox">
          <div class="ibox-head">
              <div class="ibox-title">List Pages</div>
              <a href="{{ route('page.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Page</a>
          </div>
          <div class="ibox-body">
              <table class="table" id="datatable">
                <thead class="thead-default">
                  <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Modified</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($pages->count() > 0 )
                      @foreach($pages as $page)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $page->name }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                              @if($page->status == 1)
                                <span class="badge badge-success badge-pill">Published</span>
                              @else
                                <span class="badge badge-warning badge-pill">Unpublished</span>
                              @endif
                            </td>
                            <td>
                              @if($page->updated_at)
                                {{ $page->updated_at->toFormattedDateString() }}
                              @else
                                {{ $page->created_at->toFormattedDateString() }}
                              @endif
                            </td>
                            <td>
                              <a href="{{ route('page.edit', ['id' => $page->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                              <button data-toggle="modal" onclick="deleteData({{$page->id}})" data-target="#delete-page" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                          <td colspan="6" class="text-center">No pages available in table</td>
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
@foreach($pages as $page)
  <div class="modal fade" id="delete-page" aria-labelledby="delete-page" tabindex="-1" role="dialog">
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
          <p>Are your sure you want to delete this page? </p>
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
      var url = '{{ route("page.delete", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
      $("#deleteForm").submit();
    }
  </script>
@endsection