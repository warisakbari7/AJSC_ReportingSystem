@extends('../layouts/dashboardmaster')
@section('pagetitle')
صفحه اصلاح کردن گزارش
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
            <form role="form" action="{{route('report.update',$report->id)}}" method="POST" enctype="multipart/form-data" id="form_report">
                @csrf
                @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="user"> گزارش دهنده</label>
                    <select name="user" id="user" class="form-control">
                        <option selected hidden disabled>انتخاب گزارش دهنده</option>
                        @forelse ($users as $user)
                            @if($user->id == $report->user_id)
                                <option value="{{$user->id}}" selected>{{$user->name}} {{$user->lastname}} </option>
                            @else
                                <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                            @endif
                        @empty
                            <option disabled>خالی</option>
                        @endforelse
                    </select>
                    <p class="text-danger mr-2" id="user_err">
                        @if($errors->has('user'))
                            {{$errors->first('user')}}
                        @endif
                    </p>
                </div>
                <div class="form-group">
                    <label for="date">تاریخ ثبت</label>
                    <input type="date" id="date" class="form-control" name="date" value="{{$report->created_at->toDateString()}}">
                    <p class="text-danger mr-2" id="date_err">
                        @if($errors->has('date'))
                            {{$errors->first('date')}}
                        @endif
                    </p>
                </div>
                  <div>
                    <label>ویدیو <span class="font-italic font-weight-lighter">(mov, .mp4, .mkv.) </span></label>
                    <input class="d-none" type="file" name="video" id="video" accept='.mov,.mp4,.mkv'>
                    <label for="video" class="d-flex justify-content-between border  border-1 rounded">
                        <span class="text-gray text-sm-center font-weight-lighter p-2 px-3" style="background-color:#e3e3e3">جستجو</span>
                        <span class="font-italic font-weight-lighter p-2" id="lbl_video"></span>
                    </label>
                    <p class="text-danger mr-2" id="video_err">
                        @if($errors->has('video'))
                            {{$errors->first('video')}}
                        @endif
                    </p>
                  </div>

                  <div>
                    <label>صوتی <span class="font-italic font-weight-lighter"> (wav, .mp3.) </span></label>
                    <input class="d-none" type="file" name="audio" id="audio" accept='.wav,.mp3,'>
                    <label for="audio" class="d-flex justify-content-between border  border-1 rounded">
                        <span class="text-gray text-sm-center font-weight-lighter p-2 px-3" style="background-color:#e3e3e3">جستجو</span>
                        <span class="font-italic font-weight-lighter p-2" id="lbl_audio"></span>
                    </label>
                    <p class="text-danger mr-2" id="audio_err">    
                        @if($errors->has('audio'))
                            {{$errors->first('audio')}}
                        @endif
                    </p>
                  </div>
                  
                  <div>
                    <label>فایل <span class="font-italic font-weight-lighter"> (rar, .pdf, .zip.) </span></label>
                    <input class="d-none" type="file" name="file" id="file" accept=".rar,.pdf,.zip">
                    <label for="file" class="d-flex justify-content-between border  border-1 rounded">
                        <span class="text-gray text-sm-center font-weight-lighter p-2 px-3" style="background-color:#e3e3e3">جستجو</span>
                        <span class="font-italic font-weight-lighter p-2" id="lbl_file"></span>
                    </label>
                    <p class="text-danger mr-2" id="file_err">
                        @if($errors->has('file'))
                            {{$errors->first('file')}}
                        @endif
                    </p>
                  </div>



                  <div class="form-group">
                    <label for="first">نام مکمل و بست گزارش دهنده.</label>
                    <textarea name="first" id="first" cols="30" rows="5" class="form-control">{{$report->q_first}}</textarea>
                    <p class="text-sm text-danger" id="first_err">
                        @error('first')
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="second">دراین هفته چه تعداد جلسات دادخواهی با مسولین حکومتی داشته اید؟</label>
                    <textarea name="second" id="second" cols="30" rows="5" class="form-control">{{$report->q_second}}</textarea>
                    <p class="text-sm text-danger" id="second_err">
                        @error('second')
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="third">در این هفته چه تعداد جلسات دادخواهی با مسولین رسانه ها، کارمندان رسانه و ژورنالیستان داشته اید؟.</label>
                    <textarea name="third" id="third" cols="30" rows="5" class="form-control">{{$report->q_third}}</textarea>
                    <p class="text-sm text-danger" id="third_err">
                        @error('third')
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="fourth">تعداد تریننگ ها در این هفته باذکرنام و تعداد اشتراک کنندگان آن در صورت موجودیت بنویسید.</label>
                    <textarea name="fourth" id="fourth" cols="30" rows="5" class="form-control">{{$report->q_fourth}}</textarea>
                    <p class="text-sm text-danger" id="fourth_err">
                        @error('fourth')
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="form-group">
                    <label for="fifth">دست آورد خاص تان را در سه سطربنویسید، درصورت موجودیت.</label>{{$report->q_fifth}}
                    <textarea name="fifth" id="fifth" cols="30" rows="5" class="form-control">{{$report->q_fifth}}</textarea>
                    <p class="text-sm text-danger" id="fifth_err">
                        @error('fifth')
                            {{$message}}
                        @enderror
                    </p>
                </div>

                  <div class="percent w-100 text-center text-sm d-none">0%</div >
                  <div class="progress d-none">
                    <div class="bar bg-success"></div >
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" id="btn_submit" class="btn text-white" style="background: #51131c !important;">ثبت</button>
                <a href="{{route('report.show',$report->id)}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>
            </div>
            </form>
        </div>
        <!-- /.card -->
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('sweetalert/sweetalert.js')}}"></script>
<script src="{{asset('ajaxform.js')}}"></script>
<script src="{{asset('js/report/formsubmition.js')}}"></script>
@endpush
@push('styles')
<link rel="stylesheet" href="{{asset('sweetalert/sweetalert.css')}}">
@endpush