@extends('../layouts/dashboardmaster')
@section('pagetitle')
صفحه زون
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header d-flex align-items-right text-white" style="background: #51121c !important;">
              <h3 class="card-title">فورم زون</h3>
            </div>
            {{-- start of form --}}
            <form action="{{route('zone.store')}}" id="zoneform" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="zonename">نام زون</label>
                            <input type="text" class="form-control" name="name" id="zonename" placeholder="زون...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="mr-4 mt-3 px-0 text-sm text-danger" id="err_msg"></p>
                        </div>
                        <div class="col-6">
                            <div id="success_msg" class="bg-success rounded p-0 mt-3 px-3" style="visibility:hidden"> <i class="fa fa-check  w-25 text-right"></i><div class="w-75 float-left">موفقانه ثبت شد.</div></div>
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-block text-white" style="background: #51121c !important;" disabled id="btn_submit">ثبت</button>
                </div>
            </form>
            {{-- end form --}}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
            <div class="card">
              <div class="card-header">

                <div class="d-flex justify-content-between">
                    <h5 class="text-md">فهرست زون ها</h5>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>شماره</th>
                      <th>نام</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="zone_tbl">
                    @forelse ($zones as $zone)
                        <tr id="{{$zone->id}}" data-zone="{{$zone->name}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$zone->name}}</td>
                            <td><a href="javascript:void(0)"><i class="fa fa-trash text-sm text-gray"></i></a></td>
                            <td><a href="javascript:void(0)"><i class="fa fa-edit text-sm text-gray"></i></a></td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center">خالی</td>
                        </tr>
                    @endforelse




                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>





  <!-- The Update Modal -->
  <div class="modal fade" id="update_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <form action="" id="update_zone">
        @csrf
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">تغیرمشخصه</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <label for="u_zonename">نام زون</label>
            <input type="hidden" name="id" value="" id="zone_id">
            <input type="text" class="form-control" name="name" id="u_zonename" placeholder="زون...">
            <div class="col-6">
                <p class="mr-4 mt-3 px-0 text-sm text-danger" id="u_err_msg"></p>
            </div>
            <div class="col-6">
                <div id="u_success_msg" class="bg-success rounded p-0 mt-3 px-3" style="visibility:hidden"> <i class="fa fa-check  w-25 text-right"></i><div class="w-75 float-left">موفقانه ثبت شد.</div></div>
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف</button>
          <button class="btn btn-block text-white " style="background: #51121c !important;" disabled id="u_btn_submit">ثبت</button>

        </div>
        </form>
      </div>
    </div>
  </div>







 <!-- The Delete Modal -->
 <div class="modal fade" id="delete_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form action="" id="delete_zone">
      @csrf
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">حذف زون</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
          <p>آیا می خواهید که این زون را حذف کنید؟</p>
          <input type="hidden" name="id" value="" id="d_zone_id">
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف</button>
        <button class="btn btn-block btn-danger " disabled id="d_btn_submit">حذف</button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection
@push('scripts')
    <script src="{{asset('js/zone/zoneform.js')}}"></script>
@endpush