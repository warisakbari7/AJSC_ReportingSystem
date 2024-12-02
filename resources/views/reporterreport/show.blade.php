@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه نمایش گزارش 
@endsection
@section('styles')
@endsection
@section('content')
<div class="row py-3">
    <div class="col-12">
        <article class=" p-2 shadow-lg">
            <div class=" p-2 shadow-lg rounded" >
              <div class="h-100">
                <div> گزارش دهنده : {{$report->user->name}} {{$report->user->lastname}}</div>
                <div>زون : {{$report->user->zone?->name == null ? '':$report->user->zone->name}}</div>  
                <div>تاریخ : <i class="el el-time mb-2">{{$report->created_at->format('d/m/Y')}}</i></div>
              </div>
            </div>
            <div class="bg-white p-2 my-3">
              <div class="w-100 text-right">
                <a href="{{route('reporter-report.detailsreports.create',$report->id)}}" class="border p-1 rounded " style="background: #51131c !important; color:white !important; margin-top:5px !important;"><i class="fa fa-plus"></i> ثبت عنوان</a>
              </div>
              @foreach ($report->details as $detail)
                <h5 class="p-2 text-break mt-2" id="report_tilte" data-report="{{$detail->id}}">{{$detail->title}}</h5>
                <p class="p-2 text-break" id="report_content" data-report="{{$detail->id}}">{{$detail->content}}</p>
                <div>
                  <img src="{{asset('storage/report/images/'.$detail->image)}}"  class="rounded" data-id={{$detail->id}} alt="{{$detail->title}}" width="100" height="100px;">
                  <div class="p-2">{{$detail->date}}</div>
                </div>
                <div class="text-center border border-top-1 rounded text-sm ">
                  <a href="javascript:void(0)" class="mx-2 detail_delete"><i data-id="{{$detail->id}}" class="fa fa-trash text-gray"></i></a>
                  <a href="{{route('reporter-report.detailsreports.edit',[$report,$detail->id])}}" class="mx-2"><i class="fa fa-edit text-gray"></i></a>
                </div>
              @endforeach
            </div>
              <div class="bg-white p-2">
                <h6 class="pr-3">نام مکمل و بست گزارش دهنده.</h6>
                <p class="p-3 text-break">{{$report->q_first}}</p>
                <h6 class="pr-3">دراین هفته چه تعداد جلسات دادخواهی با مسولین حکومتی داشته اید؟</h6>
                <p class=" p-3  text-break">{{$report->q_second}}</p>
                <h6 class="pr-3">در این هفته چه تعداد جلسات دادخواهی با مسولین رسانه ها، کارمندان رسانه و ژورنالیستان داشته اید؟</h6>
                <p class=" p-3 text-break">{{$report->q_third}}</p>
                <h6 class="pr-3">تعداد تریننگ ها در این هفته باذکرنام و تعداد اشتراک کنندگان آن در صورت موجودیت بنویسید.</h6>
                <p class=" p-3 text-break">{{$report->q_fourth}}</p>
                <h6 class="pr-3">دست آورد خاص تان را در سه سطربنویسید، درصورت موجودیت.</h6>
                <p class=" p-3 text-break">{{$report->q_fifth}}</p>
              </div>
        </article>
      </div>
</div>


<div class="row mt-3">
  <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h5>لیست ملاقات ها</h5>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>شماره</th>
                <th>سخن ران</th>
                <th>مقام </th>
                <th>ولایت</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($report->meetings as $meeting)
                <tr>
                  <td style="width:10% !important;">{{$loop->iteration}}</td>
                  <td class="text-truncate" style="max-width:100px;">{{$meeting->trainer}}</td>
                  <td>{{$meeting->position}}</td>
                  <td>{{$meeting->province->name}}</td>
                  <td style="width:7% !important;"><a href="{{route('reports.meetings.show',[$report,$meeting->id])}}"> <i class="fa fa-eye text-gray"></i></a> </td>
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



<div class="row mt-3">
  <div class="col-12">
    <div class="my-3 ">
      <a href="{{route('report.image.create',$report->id)}}" class="btn btn-success my-1">ثبت عکس</a>

        <a class="btn btn-secondary my-1" href="{{route('reports.meetings.create',$report->id)}}">ثبت ملاقات</a>

        
        @if($report->video != null || $report->file != null || $report->audio != null || $report->images->count() > 0 || $report->details->count() > 0)
        <a href="{{route('reporterreport.file.download',$report->id)}}" class="btn btn-info my-1">دانلودفایلها</a>
        @endif
        <a href="{{route('reporterreport.print',$report->id)}}" target="_blank" class="btn btn-warning text-white my-1">آماده چاپ</a>

        <a href="{{route('reporterreport.edit',$report->id)}}" class="btn btn-primary my-1">اصلاح</a>
        <a href="javascript:void(0)" id="delete_report" class="btn btn-danger my-1" data-id="{{$report->id}}">حذف</a>
    </div>
  </div>
</div>
@if($report->images->count() > 0)
  <div class="row mt-3">
    <div class="col-12">
      <div class="d-flex justify-content-right p-2 bg-light rounded shadow-lg" style="overflow-y: auto;">
        @foreach ($report->images as $image)
          <div class="m-1 img-cursor-pointer" >
            <img src="{{asset('storage/report/images/'.$image->image)}}"  class="rounded" data-id={{$image->id}} alt="{{$image->caption}}" width="100" height="100px;">
          </di>
        @endforeach
      </div>
    </div>
  </div>
  <div class="row mt-3 mx-1 rounded bg-light shadow-lg py-3" style="display:none" id="img-container">
    <div class="col-12 d-flex justify-content-center">
      <figure class=" w-50">
        <img src="" alt="" id="img-viewer" class="rounded"  style="height:300px !important; width:484px !important;">
        <figcaption id="img-caption" class="w-100 p-2 text-break"></figcaption>
      </figure>
    </div>
    <div class="d-flex justify-content-center  w-100">
      <a href="#delete_modal" data-toggle="modal"><i class="fa fa-trash text-gray mx-2"></i></a>
      <a href="{{route('report.image.edit',[0,'-1'])}}" id="u_img"><i class="fa fa-edit text-gray mx-2"></i></a>
    </div>
  </div>
@endif

<!-- The Delete Modalfor image -->
<div class="modal fade" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      <form action="{{route('report.image.destroy',0)}}" id="delete_form" method="post">
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


<!-- The Delete Modalfor report -->
<div class="modal fade" id="delete_report_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form action="{{route('reporterreport.destroy',0)}}" id="delete_report_form" method="post">
      @csrf
      @method('DELETE')
      <!-- Modal Header -->
      <div class="modal-header bg-danger">
        <h4 class="modal-title">حذف</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
          <p>آیا می خواهید که این را همرای تمام فایل های مرتبط حذف کنید؟</p>
          <input type="hidden" name="id" value="" id="report_id">
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

<!-- The Delete Modalfor title -->
<div class="modal fade" id="delete_title_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form action="{{route('reporter-report.detailsreports.destroy',[$report->id,0])}}" id="delete_title_form" method="post">
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
          <input type="hidden" name="id" value="" id="detail_id">
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
@push('scripts')
<script src="{{asset('js/image/gallery.js')}}"></script>
@endpush
