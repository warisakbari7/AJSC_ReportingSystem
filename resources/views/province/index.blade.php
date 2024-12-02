@extends('../layouts/dashboardmaster')
@section('pagetitle')
صفحه ولایت
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header d-flex align-items-right text-white" style="background: #51131c !important;">
              <h3 class="card-title">فورم ولایت</h3>
            </div>
            {{-- start of form --}}
            <form action="{{route('province.store')}}" method="POST" id="province_form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="zonename">نام ولایت</label>
                            <input type="text" class="form-control" id="province_name" name="name" placeholder="ولایت...">
                            <p class="text-danger text-sm mr-2" id="perror_msg"></p>
                            <div class="form-group" data-select2-id="27">
                              <label>زون</label>
                              <select class="form-control" id="zone" name="zone" placeholder="انتخاب زون" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                @forelse ($zones as $zone)
                                @if ($loop->first)
                                  <option class="text-sm text-gray" disabled selected hidden>انتخاب زون</option>
                                @endif
                                  <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @empty
                                  <option hidden>خالی</option>
                                @endforelse
                              </select>
                              <p class="text-danger text-sm mr-2" id="zerror_msg"></p>
                            </div>
                            <div style="background: rgba(0,151,19,0.3); color:darkgreen" class="rounded p-2 text-center invisible" id="success_msg"></div>
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
                    <button class="btn btn-block text-white" style="background: #51131c !important;" disabled id="btn_submit">ثبت</button>
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
                    <h5 class="text-md">فهرست ولایت ها</h5>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>شماره</th>
                      <th>نام</th>
                      <th>زون</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="province_tbl">
                    @forelse ($provinces as $province)
                        <tr id="{{$province->id}}" data-province="{{$province->name}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$province->name}}</td>
                            <td>{{$province->zone->name}}</td>
                            <td><a href="javascript:void(0)"><i class="fa fa-trash text-sm text-gray" id="delete_btn"></i></a></td>
                            <td><a href="javascript:void(0)"><i class="fa fa-edit text-sm text-gray" id="edit_btn"></i></a></td>
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
        <form action="{{route('province.update',0)}}" id="update_province">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">تغیرمشخصه</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <label for="u_provincename">نام زون</label>
                <input type="hidden" name="id" value="" id="province_id">
                <input type="text" class="form-control" name="name" id="u_province_name" placeholder="ولایت...">
                    <p class="mr-4 mt-3 px-0 text-sm text-danger" id="u_err_msg"></p>
                <label for="u_zonename">نام زون</label>
                <select class="form-control" id="u_zone" name="zone" placeholder="انتخاب زون" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  @forelse ($zones as $zone)
                  @if ($loop->first)
                    <option class="text-sm text-gray" disabled selected hidden>انتخاب زون</option>
                  @endif
                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                  @empty
                    <option hidden>خالی</option>
                  @endforelse
                </select>
                    <p class="mr-4 mt-3 px-0 text-sm text-danger" id="u_err_zone"></p> 
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف</button>
              <button class="btn btn-block btn-primary " disabled id="u_btn_submit">ثبت</button>
            </div>
        </form>
      </div>
    </div>
  </div>






  {{-- delete modal --}}

<!-- The Modal -->
<div class="modal fade" id="delete_modal" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="" id="delete_form">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">حذف ولایت</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="d_province_id">
        @csrf
        آیا می خواهید این ولایت را حذف کنید؟
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >بلی</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">منصرف</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection
@push('scripts')
    <script src="{{asset('js/province/provinceform.js')}}"></script>
@endpush