@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه ثبت عکس 
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
          <form action="{{route('report.image.update',[$report,$img->id])}}" method="POST" enctype="multipart/form-data" id="submitform">
            @csrf
            @method('PUT')
            <div class="card-header d-flex justify-content-start text-white" style="background: #51131c !important;">
              <h3 class="card-title">فورم اصلاح عکس</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <div class="p-3">
                <label>عکس <span class="font-italic font-weight-lighter">(jpg, .jpeg, .png.) </span></label>
                <input class="d-none" type="file" name="image" id="image" accept='.jpeg,.jpg,.png' disabled>
                <label for="image" class="d-flex justify-content-between border  border-1 rounded" id="img_lbl">
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
                <input type="checkbox" name="change" id="change" class="form-contrl">
                <label for="change" class="text-sm">تغیر عکس</label>

              </div>
              <div class="form-group p-3">
                <label for="caption">عنوان</label>
                <textarea name="caption" id="caption" cols="30" rows="10" class="form-control">{{$img->caption}}</textarea>
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


@endsection
@push('scripts')
<script src="{{asset('js/reportimage/imageform.js')}}"></script>
<script>
  $(()=>{
    $('#submitform').submit(e=>{
      $('#submit_btn').attr('disabled',true);
    })

    $('#change').on('change',e=>{
        let value  = $(e.target).is(':checked');
        if(value) 
        {
            $('#image').removeAttr('disabled');
            $('#img_lbl').css('cursor','pointer')
        }
        else
        {
            $('#image').attr('disabled',true);
            $('#img_lbl').css('cursor','default');            
        }
    })
  })
</script>
@endpush
















