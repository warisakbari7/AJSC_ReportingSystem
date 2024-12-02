@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه ثبت اشتراک کنندگان
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
            <form role="form" action="{{route('reports.meetings.participants.store',[$report,$meeting])}}" method="POST" enctype="multipart/form-data" id="form_report">
                @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">نام</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="نام..." value="{{old('name')}}">
                    <p class="text-danger mr-2" id="name_err">
                        @if($errors->has('name'))
                            {{$errors->first('name')}}
                        @endif
                    </p>
                </div>


                <div class="form-group">
                    <label for="position">مقام</label>
                    <input type="text" name="position" id="position" class="form-control" placeholder="مقام..." value="{{old('position')}}">
                    <p class="text-danger mr-2" id="position_err">
                        @if($errors->has('position'))
                            {{$errors->first('position')}}
                        @endif
                    </p>
                </div>


                <div class="form-group">
                    <label for="organization">سازمان مرتبط</label>
                    <input type="text" name="organization" id="organization" class="form-control" placeholder="سازمان مرتبط..." value="{{old('organization')}}">
                    <p class="text-danger mr-2" id="organization_err">
                        @if($errors->has('organization'))
                            {{$errors->first('organization')}}
                        @endif
                    </p>
                </div>

                
                <div class="form-group">
                    <label for="address">آدرس</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="آدرس..." value="{{old('address')}}">
                    <p class="text-danger mr-2" id="address_err">
                        @if($errors->has('address'))
                            {{$errors->first('address')}}
                        @endif
                    </p>
                </div>


                <div class="form-group">
                    <label for="province"> ولایت</label>
                    <select name="province" id="province" class="form-control">
                        <option selected hidden disabled>ولایت</option>
                        @forelse ($provinces as $province)
                            <option value="{{$province->id}}">{{$province->name}}</option>
                        @empty
                            <option disabled>خالی</option>
                        @endforelse
                    </select>
                    <p class="text-danger mr-2" id="province_err">
                        @if($errors->has('province'))
                            {{$errors->first('province')}}
                        @endif
                    </p>
                </div>



                <div class="form-group">
                    <label for="phone">تیلفون</label>
                    <input type="tel" name="phone" id="address" class="form-control" placeholder="تیلفون..." value="{{old('phone')}}">
                    <p class="text-danger mr-2" id="phone_err">
                        @if($errors->has('phone'))
                            {{$errors->first('phone')}}
                        @endif
                    </p>
                </div>


                

                <div class="form-group">
                    <label for="email">ایمیل آدرس</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="ایمیل..." value="{{old('email')}}">
                    <p class="text-danger mr-2" id="paddress_err">
                        @if($errors->has('email'))
                            {{$errors->first('email')}}
                        @endif
                    </p>
                </div>


        
                <div class="form-group">
                    <label for="">ملاحظات</label>
                    <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control" placeholder="ملاحظات">{{old('remarks')}}</textarea>
                    <p class="text-danger mr-2" id="remarks_err">
                        @if($errors->has('remarks'))
                            {{$errors->first('remarks')}}
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