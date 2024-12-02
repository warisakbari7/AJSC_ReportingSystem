<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('changepassword.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'oldpass' => 'required',
            'password' => ['required','confirmed',Rules\Password::defaults()],
        ]);
        if(Hash::check($request->oldpass,Auth::user()->password))
        {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            toast('موفقانه ثبت شد.','success')->width('450px');
            return redirect()->route('report.index');
        }
        else
        {
            Session::flash('msg','رمز قبلی اشتباه است!');
            return back();
        }
    }
}
