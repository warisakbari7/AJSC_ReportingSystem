<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth()->user()->user_type == 'super_admin' || Auth()->user()->user_type == 'admin')
        {
            $users = User::where('user_type','reporter')->get();
            return view('reporter.index',compact('users'));
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
        $zones = zone::all('id','name');
        if(Auth()->user()->user_type == 'super_admin' || Auth()->user()->user_type == 'admin')
        return view('reporter.create',compact('zones'));
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
        if(Auth()->user()->user_type == 'super_admin' || Auth()->user()->user_type == 'admin')
        {
            $request->validate([
                'name' => ['required'],
                'lastname' => ['required',],
                'phone' => ['required','max:13','unique:'.User::class],
                'email' => ['required','email','unique:'.User::class],
                'zone' => ['required'],
                'password' => ['required','confirmed', Rules\Password::defaults()],
            ]);
    
            $user = User::create([
                'name' => trim($request->name),
                'lastname' => trim($request->lastname),
                'email' => trim($request->email),
                'phone' => trim($request->phone),
                'zone_id' => $request->zone,
                'user_type' => 'reporter', 
                'password' => Hash::make($request->password),
            ]);
            toast('موفقانه ثبت شد.','success')->width('450px');
    
    
            return redirect()->route('reporter.index');
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
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth()->user()->user_type == 'super_admin' || Auth()->user()->user_type == 'admin')
        {
            $user = User::find($id);
            $zones = Zone::all();
            return view('reporter.edit',compact('user','zones'));
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
        if(Auth()->user()->user_type == 'super_admin' || Auth()->user()->user_type == 'admin')
        {
            $user = User::find($id);
            if($request->password != null)
            {
                $request->validate([
                    'name' => ['required'],
                    'lastname' => ['required',],
                    'phone' => ['required','max:13', 'unique:'.User::class.',email,'.$user->id],
                    'email' => ['required','email','unique:'.User::class.',email,'.$user->id],
                    'zone' => ['required'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
                $user->update([
                    'name' => trim($request->name),
                    'lastname' => trim($request->lastname),
                    'email' => trim($request->email),
                    'phone' => trim($request->phone),
                    'zone_id' => $request->zone,
                    'user_type' => 'reporter', 
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
                    'zone' => ['required'],
                ]);
                $user->update([
                    'name' => trim($request->name),
                    'lastname' => trim($request->lastname),
                    'email' => trim($request->email),
                    'phone' => trim($request->phone),
                    'zone_id' => $request->zone,
                    'user_type' => 'reporter', 
                ]);
            }
            toast('موفقانه ثبت شد.','success')->width('450px');
            return redirect()->route('reporter.index');
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
        if((Auth()->user()->user_type == 'super_admin') || (Auth()->user()->user_type == 'admin') )
        {
            $user = user::find($id);
            $user->delete();
            toast('موفقانه حذف شد.','success')->width('450px');
            return redirect()->route('reporter.index');
        }
        return abort(404);

    }

    public function search(Request $request)
    {
        
        $users = User::where('user_type','reporter')
        ->where('name','like','%'.trim($request->name).'%')      
        ->orWhere('lastname','like','%'.trim($request->name).'%')
        ->where('user_type','reporter')
        ->get();
        return view('reporter.search',compact('users'));
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
