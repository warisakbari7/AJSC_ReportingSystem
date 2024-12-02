@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه ثبت گزارش ماه وار
@endsection
@section('content')
<div class="row">
    <div class="col-12 py-3">
        <div class="card card-primary">
            <div class="card-header d-flex justify-conten-end text-white" style="background: #51131c !important;">
                <h3 class="card-title">فورم راجستر</h3>
            </div>
          <!-- /.card-header -->
          <form action="{{route('monthlyreport.store')}}" method="POST">
            @csrf
            <div class="card-body p-3">
                
                <div class="form-group">
                    <label for="date">تاریخ</label>
                    <input type="date" name="date" id="date" class="form-control">
                    @error('date')
                        <p class="text-sm text-danger">{{$message}}</p>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="content">تحلیل کلی وضعیت رسانه ها در زون :</label>
                    <textarea name="content" id="first" cols="30" rows="15" class="form-control">{{old('content')}}</textarea>
                    @error('content')
                        <p class="text-sm text-danger">{{$message}}</p>
                    @enderror
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn text-white" style="background: #51131c !important;">ثبت</button>
                <a href="{{route('report.index')}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>
              </div>
              <!-- /.card-body -->
          </form>
        </div>
        <!-- /.card -->
      </div>
</div>
@endsection
