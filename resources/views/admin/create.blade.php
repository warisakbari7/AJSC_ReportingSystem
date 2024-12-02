@extends('../layouts/dashboardmaster')
@section('pagetitle')
صفحه اضافه کردن ادمین
@endsection
@section('content')
<div class="container ">
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header d-flex justify-conten-end text-white" style="background: #51131c !important;">
                <h3 class="card-title">فورم راجستر</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{route('admin.store')}}" method="POST">
                @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">اسم</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="اسم..." value="{{old('name')}}">
                    @if($errors->has('name'))
                        <p class="text-danger mr-2">{{$errors->first('name')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="lastname">تخلص</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="تخلص..." value="{{old('lastname')}}">
                    @if($errors->has('lastname'))
                        <p class="text-danger mr-2">{{$errors->first('lastname')}}</p>
                    @endif
                </div>
                <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="ایمیل...">
                @if($errors->has('email'))
                    <p class="text-danger mr-2">{{$errors->first('email')}}</p>
                @endif
                </div>
                <div class="form-group">
                    <label for="phone">تیلفون</label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="شماره تیلفون..." value="{{old('phone')}}">
                    @if($errors->has('phone'))
                        <p class="text-danger mr-2">{{$errors->first('phone')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">رمز</label>
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
                <a href="{{route('admin.index')}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>

            </div>
            </form>
        </div>
        <!-- /.card -->
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush