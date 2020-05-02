@extends('layouts.admin')
@section('title') Trashed @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection
@section('contents')
<div class="page-content fade-in-up">
  <div class="row">
    <div class="col-xl-12">
      <div class="ibox">
        <form action="{{ route('item.restore') }}" method="post">
          @csrf
          <div class="ibox-head">
              <div class="ibox-title">List Trashed</div>
              <button type="submit" onclick="return confirm('Are you sure you want to restore this items?');" class="btn btn-sm btn-primary"><i class="fa fa-history"></i> Restore</button>
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
                    <th>Image</th>
                    <th width="20%">Name</th>
                    <th>item</th>
                    <th>Downlaod</th>
                    <th>Status</th>
                    <th>Modified</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if($items->count() > 0 )
                      @foreach($items as $item)
                        <tr>
                          <td class="check-cell rowlink-skip">
                              <label class="checkbox checkbox-primary check-single">
                                <input class="check" name="id[]" type="checkbox" value="{{ $item->id }}">
                                  <span class="input-span"></span>
                              </label>
                            </td>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                              @if(file_exists($item->image))
                                <img src="{{ url($item->image) }}" height="50px" width="80px">
                              @else
                                <img src="{{ asset('assets/img/no-image.png') }}" height="50px" width="80px">
                              @endif
                            </td>
                            <td>{{ Str::limit($item->name, 60) }}</td>
                            <td>
                              @if($item->category_id != null)
                              <span class="badge badge-primary badge-pill">{{ $item->category['name'] }}</span> 
                              @else
                                <span class="badge badge-warning badge-pill">Uncategorized</span>
                              @endif                             
                            </td>
                            <td>
                              @if(is_null($item->download))
                                <i class="fa fa-download"></i> 0 times
                              @else
                              <i class="fa fa-download"></i> {{$item->download}} times
                              @endif
                            </td>
                            <td>
                              @if($item->status == 0)
                                <span class="badge badge-warning badge-pill">Deactive</span>
                              @else
                                <span class="badge badge-success badge-pill">Active</span>
                              @endif
                            </td>
                            <td>
                              @if($item->updated_at)
                                {{ $item->updated_at->toFormattedDateString() }}
                              @else
                                {{ $item->created_at->toFormattedDateString() }}
                              @endif
                            </td>
                            <td>
                              <a href="" data-toggle="modal" onclick="destroyData({{$item->id}})" data-target="#destroy-item" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Destroy</a>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                          <td colspan="8" class="text-center">No items available in table</td>
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
<!-- Modal -->
@foreach($items as $item)
  <div class="modal fade" id="destroy-item" aria-labelledby="destroy-item" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form class="modal-content" action="" id="destroyForm">
        @csrf
        <div class="modal-header p-4">
          <h5 class="modal-title">Destroy ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body p-4">
          <p>Are your sure you want to destroy this item permanently? </p>
        </div>
        <div class="modal-footer justify-content-start">
          <button type="button" class="btn btn-secondary btn-rounded mr-3" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          <button type="submit" class="btn btn-danger btn-rounded mr-3" data-dismiss="modal" onclick="formSubmit()"><i class="fa fa-trash"></i> Destroy</button>
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
  <script type="text/javascript">
    function destroyData(id)
    {
      var id = id;
      var url = '{{ route("item.destroy", ":id") }}';
      url = url.replace(':id', id);
      $("#destroyForm").attr('action', url);
    }

    function formSubmit()
    {
      $("#destroyForm").submit();
    }
  </script>
@endsection