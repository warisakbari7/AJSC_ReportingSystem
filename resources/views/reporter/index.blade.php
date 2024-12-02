@extends('../layouts/dashboardmaster')
@section('pagetitle')
صفحه گزارشگر
@endsection
@section('content')
<div class="row">
    <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="text-md">فهرست گزارشگر ها</h5>
                    <form class="form-inline ml-3" action="{{route('reporter.search')}}" method="get">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" name="name" type="search" placeholder="نام " aria-label="Search">
                          @csrf
                          <div class="input-group-append border border-1 rounded border-gray-800">
                              <button class="btn btn-navbar" type="submit">
                              <i class="fas fa-search"></i>
                              </button>
                          </div>
                      </div>
                    </form>
                    <a href="{{route('reporter.create')}}" class="btn text-white" style="background: #51131c !important;">اضافه کردن گزارشگر</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>شماره</th>
                      <th>نام و تخلص</th>
                      <th>ایمیل</th>
                      <th>غیر فعال</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name . ' ' . $user->lastname}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                            @if($user->disabled == 'true')
                              <div class="form-group">
                                <div class="custom-control custom-switch">                  
                                  <input type="checkbox" checked class="custom-control-input user-state" id="checkbox-{{$user->id}}">
                                  <label class="custom-control-label" for="checkbox-{{$user->id}}"></label>
                                </div>
                              </div>
                            @else
                              <div class="form-group">
                                <div class="custom-control custom-switch">                  
                                  <input type="checkbox" class="custom-control-input user-state" id="checkbox-{{$user->id}}">
                                  <label class="custom-control-label" for="checkbox-{{$user->id}}" ></label>
                                </div>
                              </div>
                            @endif
                            </td>
                            <td><a href="#deleteModal" data-toggle="modal"><i class="fa fa-trash text-sm text-gray" id="{{$user->id}}"></i></a></td>
                            <td><a href="{{route('reporter.edit',$user->id)}}"><i class="fa fa-edit text-sm text-gray"></i></a></td>
                        </tr>                            
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">خالی</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
</div>






<!-- The Modal -->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <form action="{{route('reporter.destroy',0)}}" method="post" enctype="multipart/form-data" id="deleteform">
      <!-- Modal Header -->
      @method('delete')
      @csrf
      <div class="modal-header">
        <h4 class="modal-title"> توجه</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
        آیا میخواهید این کاربر را حذف کنید؟
        <input type="hidden" id="deleteid">
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">منصرف</button>
        <button type="submit" class="btn btn-primary">بلی</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>

</script>
<script src="{{asset('js/reporter/reporter.js')}}"></script>
@endpush