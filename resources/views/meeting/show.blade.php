@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه نمایش  ملاقات
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card card-primary card-outline" style="border-top-color: #51131c !important;">
            <div class="card-body box-profile">
              

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b> سخن ران</b> <a class="float-right">{{$meeting->trainer}}</a>
                </li>                <li class="list-group-item">
                  <b> مقام</b> <a class="float-right">{{$meeting->position}}</a>
                </li>

                <li class="list-group-item">
                  <b>سازمان مرتبط</b> <a class="float-right">{{$meeting->affiliated_organization}}</a>
                </li>
                <li class="list-group-item">
                  <b>ولایت</b> <a class="float-right">{{$meeting->province->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>آدرس</b> <a class="float-right">{{$meeting->address}}</a>
                </li>
                <li class="list-group-item">
                    <b>شروع</b> <a class="float-right">{{$meeting->start_time}}</a>
                </li>
                <li class="list-group-item">
                    <b>ختم</b> <a class="float-right">{{$meeting->end_time}}</a>
                </li>
                <li class="list-group-item">
                  <b>نکات مهم</b> 
                </li>
                <p class="p-2 border border-1 rounded ">{{$meeting->talkingpoints}}</p>
            
                <li class="list-group-item">
                    <b>نتیجه</b> 
                </li>
                <p class="p-2 border border-1 rounded ">{{$meeting->outcome}}</p>
              </ul>

              <div class="text-center">
                <a href="#delete_meeting_modal" data-toggle="modal" class="text-secondary"><i class="fa fa-trash"></i></a>
                <a href="{{route('reports.meetings.edit',[$meeting->report_id,$meeting->id])}}" class="text-secondary"><i class="fa fa-edit"></i></a>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>
<div class="row mt-3">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h5 class="float-left">اشتراک کنندگان</h5>
          <a href="{{route('reports.meetings.participants.create',[$report,$meeting])}}" class="btn float-right text-white" style="background: #51131c !important;">ثبت اشتراک کننده</a>
        </div>  
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>شماره</th>
                <th>نام</th>
                <th>مقام </th>
                <th>ایمیل</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($meeting->participants as $par)
                <tr>
                  <td style="width:10% !important;">{{$loop->iteration}}</td>
                  <td class="text-truncate" style="max-width:100px;">{{$par->name}}</td>
                  <td>{{$par->position}}</td>
                  <td>{{$par->email}}</td>
                  <td style="width:7% !important;"><a href="{{route('reports.meetings.participants.show',[$report,$meeting,$par->id])}}"> <i class="fa fa-eye text-gray"></i></a> </td>
                </tr>                
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                  <td colspan="5">
                      
                  </td>
              </tr>
            </tfoot>
          </table>
        </div>

      <!-- /.card-body -->
    </div>


  </div>
</div>

<!-- The Delete Modalfor report -->
<div class="modal fade" id="delete_meeting_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <form action="{{route('reports.meetings.destroy',[$meeting->report_id,$meeting->id])}}" method="post">
        @csrf
        @method('DELETE')
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title">حذف</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <p>آیا می خواهید که این ملاقات را حذف کنید؟</p>
        </div>  
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف</button>
          <button class="btn btn-block btn-danger" id="d_btn_submit">حذف</button>  
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection