@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه ثبت موضوع جلسه
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
            <form role="form" action="{{route('reports.meetings.store',$report)}}" method="POST" enctype="multipart/form-data" id="form_report">
                @csrf
            <div class="card-body">

                <div class="form-group">
                    <label for="name">نام سخن ران</label>
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
                    <label for="mainpoints">نکات مهم جلسه</label>
                    <textarea name="mainpoints" id="mainpoints" cols="30" rows="10" class="form-control" placeholder="نکات...">{{old('mainpoints')}}</textarea>
                    <p class="text-danger mr-2" id="mainpoints_err">
                        @if($errors->has('mainpoints'))
                            {{$errors->first('mainpoints')}}
                        @endif
                    </p>
                </div>


                <div class="form-group">
                    <label for="start">ساعت شروع</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" placeholder="" value="{{old('start')}}">
                    <p class="text-danger mr-2" id="start_err">
                        @if($errors->has('start'))
                            {{$errors->first('start')}}
                        @endif
                    </p>
                </div>

                <div class="form-group">
                    <label for="end">ساعت ختم</label>
                    <input type="datetime-local" name="end" id="end" class="form-control" placeholder="" value="{{old('end')}}">
                    <p class="text-danger mr-2" id="address_err">
                        @if($errors->has('end'))
                            {{$errors->first('end')}}
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
                    <label for="">نتیجه</label>
                    <textarea name="outcome" id="outcome" cols="30" rows="10" class="form-control" placeholder="خلاصه جلسه">{{old('outcome')}}</textarea>
                    <p class="text-danger mr-2" id="outcome_err">
                        @if($errors->has('outcome'))
                            {{$errors->first('outcome')}}
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