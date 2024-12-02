@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه ثبت عکس 
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <form action="{{route('report.image.store',$img)}}" method="POST" enctype="multipart/form-data" id="submitform">
            @csrf
            <div class="card-header d-flex justify-content-start text-white" style="background: #51131c !important;">
              <h3 class="card-title">فورم ثبت عکس</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <div class="p-3">
                <label>عکس <span class="font-italic font-weight-lighter">(jpg, .jpeg, .png.) </span></label>
                <input class="d-none" type="file" name="image" id="image" accept='.jpeg,.jpg,.png'>
                <label for="image" class="d-flex justify-content-between border  border-1 rounded">
                    <span class="text-gray text-sm-center font-weight-lighter p-2 px-3" style="background-color:#e3e3e3">جستجو</span>
                    <span class="font-italic font-weight-lighter p-2" id="lbl_image"></span>
                </label>
                <p class="text-danger mr-2" id="image_err">
                    @if($errors->has('image'))
                        {{$errors->first('image')}}
                    @endif
                </p>
              </div>
              <div class="form-group p-3">
                <label for="caption">عنوان</label>
                <textarea name="caption" id="caption" cols="30" rows="10" class="form-control"></textarea>
                <p class="text-danger mr-2" id="caption_err">
                    @if($errors->has('caption'))
                        {{$errors->first('caption')}}
                    @endif
                </p>
              </div>

            </div>
            <div class="card-footer">
              <button class="btn text-white" style="background: #51131c !important;" id="submit_btn">ثبت</button>
            </div>
          </form>
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
<script src="{{asset('js/reportimage/imageform.js')}}"></script>
<script>
  $(()=>{
    $('#submitform').submit(e=>{
      $('#submit_btn').attr('disabled',true);
    })
  })
</script>
@endpush
















