@extends('layouts.admin')
@section('title') Items @endsection
@section('styles')
<link href="{{ asset('assets/vendors/dataTables/datatables.min.css') }}" rel="stylesheet" />
@endsection
@section('contents')
<div class="page-content fade-in-up">
  <div class="row">
    <div class="col-xl-12">
      <div class="ibox">
        <form action="{{ route('item.delete') }}" method="post">
          @csrf
          <div class="ibox-head">
              <div class="ibox-title">List Items</div>
              <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
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
                    <th>Category</th>
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
                                <i class="fa fa-download"></i> 0 time
                              @elseif($item->download <= 1)
                                <i class="fa fa-download"></i> {{$item->download}} time
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
                              @if(file_exists($item->file))
                                <a href="{{ url($item->file) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i></a>
                              @elseif($item->download_link)
                                <a href="{{$item->download_link }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i></a>
                              @else
                                <a class="btn btn-secondary btn-sm"><i class="fa fa-download"></i></a>
                              @endif
                              <a href="{{ route('item.edit', ['id' => $item->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                              <style type="text/css"></style>
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