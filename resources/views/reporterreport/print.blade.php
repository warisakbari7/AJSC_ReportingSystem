<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{asset('bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.css')}}">
    <style>
      @media print {
                #print_btn
                  {
                    display: none;
                  }
                }

    </style>
</head>
<body>
    <div class="row">
        <div class="col-12">
            <article class=" p-2 bg-white">
                <div class=" p-2 border border-1 rounded" >
                  <div class="h-100" style="direction: rtl;">
                    <div> گزارش دهنده : {{$reporter}}</div>
                    <div>زون : {{$zone}}</div>  
                    <div>تاریخ : <i class="el el-time mb-2">{{$date}}</i></div>
                    <div>تاریخ چاپ : <i class="el el-time mb-2">{{$printdate}}</i></div>
                  </div>
                  <div class="p-2">
                    <a onclick="print()" id="print_btn" class="btn text-sm " style="color: #563D7C; border: 1px solid #563D7C"> <i class="fa fa-print text-sm"></i> چاپ</a>
                  </div>
                </div>
                <div>
                  @foreach ($report as $detail)
                    <h5 class="text-center p-2 text-break" style="text-align:center;" id="report_tilte" data-report="{{$id}}">{{$detail['title']}}</h5>
                    <p class=" p-3 bg-white text-break" style="direction:rtl">{{$detail['content']}}</p>
                    <img src="{{asset('storage/report/images/'.$detail['image'])}}" alt="">
                    <div>
                      <time datetime="{{$detail['date']}}">{{$detail['date']}}</time>
                    </div>
                  @endforeach
                </div>

                  
                <h6 class="p-3 bg-white text-break">.نام مکمل و بست گزارش دهنده</h6>
                <p class=" p-3 bg-white text-break" style="direction:rtl">{{$q_first}}</p>

                <h6 class="p-3 bg-white text-break">دراین هفته چه تعداد جلسات دادخواهی با مسولین حکومتی داشته اید؟</h6>
                <p class=" p-3 bg-white text-break" style="direction:rtl">{{$q_second}}</p>

                <h6 class="p-3 bg-white text-break">در این هفته چه تعداد جلسات دادخواهی با مسولین رسانه ها، کارمندان رسانه و ژورنالیستان داشته اید؟</h6>
                <p class=" p-3 bg-white text-break" style="direction:rtl">{{$q_third}}</p>

                <h6 class="p-3 bg-white text-break">.تعداد تریننگ ها در این هفته باذکرنام و تعداد اشتراک کنندگان آن در صورت موجودیت بنویسید</h6>
                <p class=" p-3 bg-white text-break" style="direction:rtl">{{$q_fourth}}</p>

                <h6 class="p-3 bg-white text-break">.دست آورد خاص تان را در سه سطربنویسید، درصورت موجودیت</h6>
                <p class=" p-3 bg-white text-break" style="direction:rtl">{{$q_fifth}}</p>
                  
            </article>
          </div>
    </div>
      <div class="row mt-3 mx-1 rounded   py-3" id="img-container">
        @foreach ($images as $img)
        <div class="col-12 d-flex justify-content-center">
            <figure class="w-50" style="direction:rtl;">
              <img src="{{asset('storage/report/images/'.$img['image'])}}" alt="" id="img-viewer" class="rounded"  style="height:300px !important; width:484px !important;">
              <figcaption id="img-caption" class="w-100 p-2" style="word-break:break-word;width:484px !important;">{{$img['caption']}}</figcaption>
            </figure>
          </div>    
        @endforeach
      </div>
      <script>
        print(){
          window.print();
        }
      </script>
</body>
</html>
