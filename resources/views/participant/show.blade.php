@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه نمایش اشتراک کننده
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card card-primary card-outline" style="border-top-color: #51131c !important;">
            <div class="card-body box-profile">
              

              <h3 class="profile-username text-center">{{$participant->name}}</h3>

              <p class="text-muted text-center">{{$participant->position}}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>سازمان مرتبط</b> <a class="float-right">{{$participant->affiliated_organization}}</a>
                </li>
                <li class="list-group-item">
                  <b>ولایت</b> <a class="float-right">{{$participant->province->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>آدرس</b> <a class="float-right">{{$participant->address}}</a>
                </li>
                <li class="list-group-item">
                    <b>تیلفون</b> <a class="float-right">{{$participant->phone}}</a>
                </li>
                <li class="list-group-item">
                    <b>ایمیل</b> <a class="float-right">{{$participant->email}}</a>
                </li>
                <li class="list-group-item">
                    <b>ملاحظات</b> 
                </li>
                <p class="p-2 border border-1 rounded ">{{$participant->remarks}}</p>
              </ul>

              <div class="text-center">
                <a href="#delete_participant_modal" data-toggle="modal" class="text-secondary"><i class="fa fa-trash"></i></a>
                <a href="{{route('reports.meetings.participants.edit',[$report,$participant->meeting_id,$participant->id])}}" class="text-secondary"><i class="fa fa-edit"></i></a>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
</div>

<!-- The Delete Modalfor report -->
<div class="modal fade" id="delete_participant_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <form action="{{route('reports.meetings.participants.destroy',[$report,$participant->meeting_id,$participant->id])}}" method="post">
        @csrf
        @method('DELETE')
        <!-- Modal Header -->
        <div class="modal-header bg-danger">
          <h4 class="modal-title">حذف</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <p>آیا می خواهید که این اشتراک کننده را حذف کنید؟</p>
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