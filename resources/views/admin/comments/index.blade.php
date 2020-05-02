@extends('layouts.admin')
@section('title') Comments @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection

@section('contents')
<div class="page-content fade-in-up">
  <div class="row">
    <div class="col-xl-12">
      <div class="ibox">
        <form action="{{ route('comment.delete') }}" method="post">
          @csrf
          <div class="ibox-head">
              <div class="ibox-title">List Comments</div>
              <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
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
                    <th width="50%">Comment</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($comments->count() > 0 )
                      @foreach($comments as $comment)
                        <tr>
                            <td class="check-cell rowlink-skip">
                                <label class="checkbox checkbox-primary check-single">
                                  <input class="check" name="id[]" type="checkbox" value="{{ $comment->id }}">
                                    <span class="input-span"></span>
                                </label>
                            </td>
                            <td>{{ $loop->index+1 }}</td>
                             <td>{{ $comment->name }}<br><small>{{ $comment->email}}</small></td>
                            <td>{{ Str::limit($comment->body, 150) }}</td>
                            <td>
                              @if($comment->status == 'approved')
                                <span class="badge badge-primary badge-pill">Approved</span>
                              @elseif($comment->status == 'pending')
                                <span class="badge badge-warning badge-pill">Pending</span>
                              @else
                                <span class="badge badge-danger badge-pill">Spam</span>
                              @endif
                            </td>
                            <td>
                              <a href="{{ route('comment.edit', ['id' => $comment->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                          <td colspan="5" class="text-center">No comments available in table</td>
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