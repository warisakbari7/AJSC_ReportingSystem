@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه لیست گزارش 
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <form class="" id="search_form" action="{{route('report.search')}}" method="POST">
            @csrf
            <div class="card-header d-flex justify-content-around">
              <div class="w-75 d-flex justify-between">
                <div class="mx-2">
                  <label for="">جستجو به اساس :  </label>
                  <select name="search" id="search_field" class="p-1 rounded">
                    <option value="1" selected>عنوان</option>
                    <option value="2">زون</option>
                    <option value="3">گزارشگر</option>
                  </select>
                </div>
                <div>
                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" name="key" id="key_field" type="search" placeholder="عنوان..." aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                </div>
              </div>
              <div class="w-25 d-flex justify-content-end">
                <a href="{{route('report.create')}}" class="btn text-white" style="background: #51131c !important;">ثبت گزارش</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>شماره</th>
                    <th >گزارشگر</th>
                    <th>تاریخ </th>
                    <th>زون</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ( $reports as $report)
                      <tr>
                          <td style="width:10% !important;">{{ $loop->iteration }}</td>
                          <td class="text-truncate" style="max-width:100px;" >{{ $report->user->name }} {{ $report->user->lastname }}</td>
                          <td>{{$report->created_at->format('d/m/Y')}}</td>
                          <td>{{$report->user->zone?->name}} </td>
                          <td style="width:7% !important;"><a href="{{route('report.show',$report->id)}}"> <i class="fa fa-eye text-gray" ></i></a> </td>

                    </tr>
                  @empty
                      <tr>
                          <td colspan="5" class="text-center">خالی</td>
                      </tr>
                  @endforelse

                </tbody>
                <tfoot>
                  <tr >
                      <td colspan="5">
                          {{ $reports->links()}}
                      </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </form>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>

@endsection
@push('scripts')
<script>
  $('#search_form').submit(e=>{
    let key = jQuery.trim($('#key_field').val());
    let search = jQuery.trim($('#search_field').val());
    if(search == '')
    {
      e.preventDefault();
    }
    if(key == '')
    {
      $('#key_field').val('')
      e.preventDefault();
    }
  })
</script>
@endpush
















