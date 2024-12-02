@extends('layouts.dashboardmaster')
@section('pagetitle')
صفحه جدول گزارش هفته وار
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
              
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">گزارش های روزانه</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">گزارش اخیر هفته</a>
                </li>
              </ul>
              <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>شماره</th>
                              <th >عنوان</th>
                              <th>تاریخ </th>
                              <th>زون</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ( $dailyreports as $dreport)
                                <tr>
                                    <td style="width:10% !important;">{{ $loop->iteration }}</td>
                                    <td class="text-truncate" style="max-width:100px;" >{{ $dreport->title }}</td>
                                    <td>{{$dreport->created_at->format('d/m/Y')}}</td>
                                    <td>{{$dreport->user->zone?->name}} </td>
                                    <td style="width:7% !important;"><a href="{{route('report.show',$dreport->id)}}"> <i class="fa fa-eye text-gray" ></i></a> </td>
          
                              </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">خالی</td>
                                </tr>
                            @endforelse
          
                          </tbody>
                          <tfoot>
                            <tr >
                                <td colspan="5">
                                    {{ $dailyreports->links()}}
                                </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div> 
                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
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
                                <th>زون</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ( $weeklyreports as $wreport)
                                  <tr>
                                      <td>{{$loop->iteration}}</td>
                                      <td>{{$wreport->dateschedule->start_date}} | {{$wreport->dateschedule->end_date}}</td>
                                      <td>{{$wreport->user->name}} {{$wreport->user->lastname}}</td>
                                      <td>{{$wreport->user->zone->name}}</td>
                                      <td><a href="{{route('weeklyreport.show',$wreport->id)}}"> <i class="fa fa-eye text-gray"></i></a> </td>
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
                                      {{ $weeklyreports->links()}}
                                  </td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div> 
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>        
    </div>
 
</div>

@endsection
@push('scripts')
@endpush
