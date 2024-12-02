@extends('../layouts/dashboardmaster')
@section('pagetitle')
صفحه تصحیح معلومات سوپر ادمین
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header d-flex justify-conten-end text-white" style="background: #51131c !important;">
                    <h3 class="card-title">فورم تصحیح</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                <form action="{{route('super-admin.update',$user->id)}}" method="post" enctype="multipart/form-data">
                @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">اسم</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="اسم..." value="{{$user->name}}">
                            @if($errors->has('name'))
                                <p class="text-danger mr-2">{{$errors->first('name')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="lastname">تخلص</label>
                            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="تخلص..." value="{{$user->lastname}}">
                            @if($errors->has('lastname'))
                                <p class="text-danger mr-2">{{$errors->first('lastname')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">ایمیل</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" placeholder="ایمیل...">
                            @if($errors->has('email'))
                                <p class="text-danger mr-2">{{$errors->first('email')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone">تیلفون</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="شماره تیلفون..." value="{{$user->phone}}">
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
                        <a href="{{route('super-admin.index')}}" class="btn text-white" style="background: #51131c !important;">منصرف</a>
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























{{-- 
public function index()
    {
        $users = User::where('user_type','super_admin')->get();
        return view('superadmin.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('dfsaasdf');
        $request->validate([
            'name' => ['required'],
            'lastname' => ['required',],
            'phone' => ['required','max:13'],
            'email' => ['required','email','unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        toast('موفقانه ثبت شد.','success')->width('450px');



        $user = User::create([
            'name' => trim($request->name),
            'lastname' => trim($request->lastname),
            'email' => trim($request->email),
            'phone' => trim($request->phone),
            'user_type' => 'super_admin', 
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        return redirect()->route('super-admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        dd('asdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('superadmin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        dd($user);
        $request->validate([
            'name' => ['required'],
            'lastname' => ['required',],
            'phone' => ['required','max:13'],
            'email' => ['required','email','unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        toast('موفقانه ثبت شد.','success')->width('450px');



        $user = User::create([
            'name' => trim($request->name),
            'lastname' => trim($request->lastname),
            'email' => trim($request->email),
            'phone' => trim($request->phone),
            'user_type' => 'super_admin', 
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        return redirect()->route('super-admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        dd('destroy');
    } --}}