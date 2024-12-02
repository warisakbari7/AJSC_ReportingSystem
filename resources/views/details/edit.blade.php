@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه اصلاح  عنوان
@endsection
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-conten-end text-white" style="background: #51131c !important;">
                <h3 class="card-title">فورم اصلاح</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('reports.details.update',[$report,$detail->id])}}" method="POST" enctype="multipart/form-data" id="form_report">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="date1">تاریخ </label>
                        <input type="date" id="date" class="form-control" name="date" value="{{$detail->date}}">
                        <p class="text-danger mr-2" id="date_err">
                            @if($errors->has('date'))
                                {{$errors->first('date')}}
                            @endif
                        </p>
                    </div>


                    <div class="form-group">
                        <label for="title">عنوان</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="عنوان..." value="{{$detail->title}}">
                        <p class="text-danger mr-2" id="title_err">
                            @if($errors->has('title'))
                                {{$errors->first('title')}}
                            @endif
                        </p>
                    </div>
        
                    <div class="form-group">
                        <label for="content">محتوا</label>
                        <textarea name="content" id="content" cols="30" rows="5" class="form-control" placeholder="محتوا">{{$detail->content}}</textarea>
                        <p class="text-danger mr-2" id="content_err">
                            @if($errors->has('content'))
                                {{$errors->first('content')}}
                            @endif
                        </p>
                    </div>
                    <div>
                        <label>تصویر <span class="font-italic font-weight-lighter"> (jpg, .jpeg, .png.) </span></label>
                        <input class="d-none r_img" type="file" name="image" id="image" accept=".jpg,.jpeg,.png">
                        <label for="image" class="d-flex justify-content-between border lbl  border-1 rounded">
                            <span class="text-gray text-sm-center font-weight-lighter p-2 px-3" style="background-color:#e3e3e3">جستجو</span>
                            <span class="font-italic font-weight-lighter lbl_name p-2" id="lbl_image"></span>
                        </label>
                        <p class="text-danger mr-2" id="image_err">
                            @if($errors->has('image'))
                                {{$errors->first('image')}}
                            @endif
                        </p>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" id="btn_submit" class="btn text-white" style="background: #51131c !important;">ثبت</button>
                    <a href="{{route('report.show',$report)}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>

                </div>
            </form>
        </div>
        <!-- /.card -->
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).on('change','input.r_img', function() {
        let img = $(this).val().split("\\").pop();
        let ext = img.substr( (img.lastIndexOf('.') +1) );
        if(img != '')
        {
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                $(this).siblings('label.lbl').children('span.lbl_name').text(img);
                $(this).siblings('p').text('')
                break;
                case "":
                $(this).siblings('label.lbl').children('span.lbl_name').text('');
                default:
                $(this).siblings('p').text('تصویر باید jgp, jpeg یا png باشد.')
                $(this).siblings('label.lbl').children('span.lbl_name').text('');
                this.value = '';
            }
            return;
        }
        else
        {
            $(this).siblings('label.lbl').children('span.lbl_name').text(img);
            $(this).siblings('p').text('');
        }
      });
    </script>
@endpush