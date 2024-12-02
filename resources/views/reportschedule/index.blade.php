@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه تاریخ گزارش هفته وار
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            @if($enddate < now())
            <div class="card-header d-flex align-items-right text-white" style="background: #51131c !important;">
                <h3 class="card-title">فورم تعین تاریخ</h3>
              </div>              
              <form action="{{route('reportschedule.store')}}" method="POST">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-12">
                              <div class="form-group">
                                  @csrf
                                  <label for="startdate">تاریخ شروع</label>
                                  <input type="date" class="form-control" name="start_date" id="startdate" value="{{old('start_date')}}">
                                  @if($errors->has('start_date'))
                                      <p class="text-danger text-sm mr-2"">{{$errors->first('start_date')}}</p> 
                                  @endif
                                  @if(session('err'))
                                      <p class="text-danger text-sm mr-2"">این تاریخ در سیستم از قبل ثبت است.</p> 
                                  @endif
                              </div>
                              <div class="form-group">
                                <label for="enddate">تاریخ ختم</label>
                                <input type="date" class="form-control" name="end_date" id="enddate" value="{{old('end_date')}}">
                                  @if($errors->has('end_date'))
                                      <p class="text-danger text-sm mr-2"">{{$errors->first('end_date')}}</p>    
                                  @endif
                              </div>
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
                      <button class="btn btn-block text-white" style="background: #51131c !important;" id="btn_submit">ثبت</button>
                  </div>
              </form>
            @else
              <div class="border border-1 py-2 border-primary shadow rounded">
                <i class="pr-3 py-2 el el-time">تاریخ ختم آخرین گزارش    : {{$enddate}}</i>
              </div>
            @endif
        </div>
    </div>
    <div class="col-12">
        <div class="card">
          <div class="card-header">
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>شماره
                  </th>
                  <th>تاریخ شروع</th>
                  <th>تاریخ ختم</th>
                  <th>گزارشها</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse ( $weeks as $week)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$week->start_date}}</td>
                        <td>{{$week->end_date}}</td>
                        <td><a href="{{route('reportschedule.show',$week->id)}}"> <i class="fa fa-eye text-gray"></i></a> </td>
                        <td><a href="javascript:void(0)"> <i class="fa fa-trash text-gray" id="{{$week->id}}"></i></a> </td>

                  </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">خالی</td>
                    </tr>
                @endforelse

              </tbody>
              <tfoot>
                <tr >
                    <td class="text-center" colspan="5">
                        {{ $weeks->links()}}
                    </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>


<!-- The Delete Modal -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <form action="{{route('reportschedule.destroy',0)}}" id="delete_form" method="post">
        @csrf
        @method('DELETE')
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title">حذف</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <p>آیا می خواهید که این را حذف کنید؟</p>
            <input type="hidden" name="id" value="" id="id">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف</button>
          <button class="btn btn-block btn-danger "  id="d_btn_submit">حذف</button>
  
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="{{asset('js/reportschedule/deleteform.js')}}"></script>
@endpush
