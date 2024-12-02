@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه گزارش ماه وار
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary text-white" style="background: #51131c !important; ">
           <a href="{{route('monthlyreport.info')}}" class="btn text-white" style="background: #51131c !important;">ثبت گزارش</a>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
          <div class="card-header">
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>شماره</th>
                  <th>تاریخ گزارش</th>
                  <th> گزارش دهنده</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @forelse ( $reports as $report)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$report->date}}</td>
                        <td>{{$report->user->name}} {{$report->user->lastname}}</td>
                        <td><a href="{{route('monthlyreport.show',$report->id)}}"> <i class="fa fa-eye text-gray"></i></a> </td>
                  </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">خالی</td>
                    </tr>
                @endforelse

              </tbody>
              <tfoot>
                <tr >
                    <td class="text-center" colspan="5">
                        {{ $reports->links()}}
                    </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/reportschedule/deleteform.js')}}"></script>
@endpush