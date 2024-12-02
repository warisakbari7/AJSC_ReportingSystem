@extends('layouts.dashboardmaster');
@section('pagetilte')
صفحه تعییر رمز
@endsection
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-conten-end text-white" style="background: #51131c !important;">
                <h3 class="card-title">فورم تغییر رمز</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('changepass.update')}}" method="POST">
                @csrf
                @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="password"> رمز قبلی</label>
                    <input type="password" name="oldpass" autocomplete="old-password" class="form-control" id="password" placeholder=" رمز قبلی...">
                    @if($errors->has('oldpass'))
                        <p class="text-danger mr-2">{{$errors->first('oldpass')}}</p>
                    @endif
                    @if(Session::has('msg'))
                        <p class="text-danger mr-2">{{Session::get('msg')}}</p>                        
                    @endif

                </div>
                <div class="form-group">
                    <label for="password">رمز جدید</label>
                    <input type="password" name="password" autocomplete="new-password" class="form-control" id="password" placeholder="رمز...">
                    @if($errors->has('password'))
                        <p class="text-danger mr-2">{{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="confirm_pass">تایید رمز</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password" class="form-control" id="confirm_pass" placeholder="رمز را دوباره وارد کنید">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn text-white" style="background: #51131c !important;">ثبت</button>
                @if(Auth::user()->user_type == 'reporter')
                <a href="{{route('reporterreport.index')}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>
                @else
                <a href="{{route('report.index')}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>
                @endif
            </div>
            </form>
        </div>
        <!-- /.card -->
        </div>
    </div>
</div>
@endsection