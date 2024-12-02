@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه نمایش گزارش ماه وار 
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
                <div>تاریخ : <span class=" mb-2">{{$report->date}} </span></div>
              </div>
            </div>
            <div>
                <h5 class="text-center p-2 text-break" id="report_tilte" data-report="{{$report->id}}">{{$report->title}}</h5>
            </div>
              <h5 class="pr-3">گزارش</h5>
              <p class="p-3 text-break">{{$report->content}}</p>
        </article>
        <div class="mt-3">
            <a href="{{route('monthlyreport.print',$report->id)}}" class="btn btn-warning text-white">آماده چاپ</a>
            <a href="{{route('monthlyreport.edit',$report->id)}}" class="btn btn-primary">اصلاح</a>
            <a href="javascript:void(0)" id="delete_report" class="btn btn-danger" data-id="{{$report->id}}">حذف</a>
        </div>
      </div>
</div>


<!-- The Delete Modalfor report -->
<div class="modal fade" id="delete_report_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form action="{{route('monthlyreport.destroy',0)}}" id="delete_report_form" method="post">
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
@endsection
@push('scripts')
<script>

  
    // deleting report

    $('#delete_report').click(e=>{
        let id = $(e.target).data('id');
        $('#report_id').val(id);
        $('#delete_report_modal').modal('show');
    })
</script>
@endpush
















