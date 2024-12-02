<?php

namespace App\Http\Controllers;

use App\Models\ReportImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ReportImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($img)
    {
        return view('reportimage.create',compact('img'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$report)
    {
        $request->validate([
            'image.*' => ['required','image','mimes:jpg,jpeg,png','max:4096'],
            'caption' => ['required']
        ]);
        $image = md5(Str::random(30).time().'_'.$request->file('image')).'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->storeAs('/report/images',$image);
        $img = new ReportImage();
        $img->image = $image;
        $img->caption = trim($request->caption);
        $img->report_id = $report;
        $img->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        if(Auth::user()->user_type == 'reporter')
        return Redirect::route('reporterreport.show',$report);
        else
        return Redirect::route('report.show',$report);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportImage  $reportImage
     * @return \Illuminate\Http\Response
     */
    public function show(ReportImage $reportImage)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportImage  $reportImage
     * @return \Illuminate\Http\Response
     */
    public function edit( $report, $img)
    {
        $img = ReportImage::find($img);
        return view('reportimage.edit',compact('img','report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportImage  $reportImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $report,$img)
    {
        if($request->change != null)
        {
            $request->validate([
                'image.*' => ['required','image','mimes:jpg,jpeg,png','max:4096'],
                'caption' => ['required']
            ]);
            $img = ReportImage::find($img);
            $image = md5(Str::random(30).time().'_'.$request->file('image')).'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/report/images',$image);
            Storage::delete('report/images/'.$img->image);
            
            $img->image = $image;
            $img->caption = trim($request->caption);
            $img->save();
            toast('موفقانه ثبت شد.','success')->width('450px');
            return Redirect::route('report.show',$report);
        }
        else
        {
            $request->validate([
                'caption' => ['required']
            ]);
            $img = ReportImage::find($img);
            $img->caption = trim($request->caption);
            $img->save();
            toast('موفقانه ثبت شد.','success')->width('450px');
            return Redirect::route('report.show',$report);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportImage  $reportImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $img = ReportImage::find($request->id);
        Storage::delete('report/images/'.$img->image);
        $img->delete();
        toast('موفقانه حذف شد. ','success')->width('450px');
        return back();
    }
}
