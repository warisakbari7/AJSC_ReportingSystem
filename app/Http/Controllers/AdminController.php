<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
            $users = User::where('user_type','admin')->get();
            return view('admin.index',compact('users'));
        }
        else
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth()->user()->user_type == 'super_admin')
        return view('admin.create');
        else
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
            $request->validate([
                'name' => ['required'],
                'lastname' => ['required',],
                'phone' => ['required','max:13','unique:'.User::class],
                'email' => ['required','email','unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
    
    
            $user = User::create([
                'name' => trim($request->name),
                'lastname' => trim($request->lastname),
                'email' => trim($request->email),
                'phone' => trim($request->phone),
                'user_type' => 'admin', 
                'password' => Hash::make($request->password),
            ]);
            toast('موفقانه ثبت شد.','success')->width('450px');
    
    
            return redirect()->route('admin.index');
        }
        else
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
            $user = User::find($id);
            return view('admin.edit',compact('user'));
        }
        else
        abort(404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
            $user = User::find($id);
            if($request->password != null)
            {
                $request->validate([
                    'name' => ['required'],
                    'lastname' => ['required',],
                    'phone' => ['required','max:13', 'unique:'.User::class.',email,'.$user->id],
                    'email' => ['required','email','unique:'.User::class.',email,'.$user->id],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
        
        
                $user->update([
                    'name' => trim($request->name),
                    'lastname' => trim($request->lastname),
                    'email' => trim($request->email),
                    'phone' => trim($request->phone),
                    'user_type' => 'admin', 
                    'password' => Hash::make($request->password),
                ]);
            }
            else
            {
                $request->validate([
                    'name' => ['required'],
                    'lastname' => ['required',],
                    'phone' => ['required','max:13', 'unique:'.User::class.',email,'.$user->id],
                    'email' => ['required','email','unique:'.User::class.',email,'.$user->id],
                ]);
        
        
                $user->update([
                    'name' => trim($request->name),
                    'lastname' => trim($request->lastname),
                    'email' => trim($request->email),
                    'phone' => trim($request->phone),
                    'user_type' => 'admin', 
                ]);
            }

            toast('موفقانه ثبت شد.','success')->width('450px');
            return redirect()->route('admin.index');
        }
        else
        abort(404);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
            $user = user::find($id);
            $user->delete();
            toast('موفقانه حذف شد.','success')->width('450px');
            return redirect()->route('admin.index');
        }
        return abort(404);

    }
    public function status(Request $request)
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
            $user = user::find($request->id);
            $user->disabled = $request->status;
            $user->save();
            return response()->json($request->toArray());
        }
    }
}
