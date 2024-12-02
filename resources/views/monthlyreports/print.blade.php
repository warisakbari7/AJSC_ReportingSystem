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
<body style="direction:rtl !important;">
  <div class="row">
    <div class="col-12">
        <article class=" p-2 shadow-lg">
            <div class=" p-2 shadow-lg rounded" >
              <div class="h-100">
                <div> گزارش دهنده : {{$report->user->name}} {{$report->user->lastname}}</div>
                <div>تاریخ : <span class=" mb-2">{{$report->date}}</span></div>
                <div>تاریخ چاپ : <i class="el el-time mb-2">{{date_format(now(),'d/m/Y - H:m:s')}}</i></div>
                <div class="p-2">
                  <a onclick="print()" id="print_btn" class="btn text-sm " style="color: #563D7C; border: 1px solid #563D7C"> <i class="fa fa-print text-sm"></i> چاپ</a>
                </div>
              </div>
            </div>
            <div>
                <h5 class="text-center p-2 text-break" id="report_tilte" data-report="{{$report->id}}">{{$report->title}}</h5>
            </div>
              <h5 class="pr-3 pl-3">گزارش</h5>
              <p class="p-3">{{$report->content}}</p>
        </article>
      </div>
</div>
      <script>
        print(){
          window.print();
        }
      </script>
</body>
</html>
