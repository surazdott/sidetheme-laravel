@extends('layouts.admin')
@section('title') Users @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection

@section('contents')
<div class="page-content fade-in-up">
  <div class="row">
    <div class="col-xl-12">
      <div class="ibox">
          <div class="ibox-head">
              <div class="ibox-title">List Users</div>
              <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add User</a>
          </div>
          <div class="ibox-body">
              <table class="table" id="datatable">
                <thead class="thead-default">
                  <tr>
                    <th>S.N</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>User Status</th>
                    <th>Join at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($users->count() > 0 )
                      @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                              @if(file_exists($user->avatar))
                              <img class="img-circle" src="{{ url($user->avatar) }}" alt="{{ $user->name }}" width="50">
                              @else
                              <img class="img-circle" src="{{ asset('assets/img/user.jpg') }}" alt="{{ $user->name }}" width="50">
                              @endif
                            </td>
                            <td>{{ $user->name }}<br><small>{{ $user->email}}</small></td>
                            <td>
                              @if($user->role == 'admin')
                                <span class="badge badge-primary badge-pill">Admin</span>
                              @else
                                <span class="badge badge-primary badge-pill">User</span>
                              @endif
                            </td>
                             <td>
                              @if($user->status == 1)
                                <span class="badge badge-success badge-pill">Active</span>
                              @else
                                <span class="badge badge-warning badge-pill">Deactive</span>
                              @endif
                            </td>
                            <td>{{ $user->created_at->toFormattedDateString() }}</td>
                            <td>
                              <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                              <button data-toggle="modal" onclick="deleteData({{$user->id}})" data-target="#delete-user" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                          <td colspan="7" class="text-center">No users available in table</td>
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
@foreach($users as $user)
  <div class="modal fade" id="delete-user" aria-labelledby="delete-user" tabindex="-1" role="dialog">
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
          <p>Are your sure you want to delete this user? </p>
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
      var url = '{{ route("user.delete", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
    }

    function formSubmit()
    {
      $("#deleteForm").submit();
    }
  </script>
@endsection