<?php

namespace App\Http\Controllers;

use App\Models\Detailsreport;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Redirect;

class ReporterReportDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function index(Report $report)
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function create( $report)
    {
        return view('reporterdetails.create',compact('report'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $report)
    {
        $request->validate([
            'date' => ['required','date'],
            'title' => ['required'],
            'content' => ['required'],
            'image' => ['required','image',File::types(['jpg','jpeg','png'])->max(100*1024)],
        ]);
        $detail = new detailsreport();
        $detail->title = trim($request->title);
        $detail->content = trim($request->content);
        $detail->date = $request->date;
        $detail->report_id = $report;
        $name = $request->file('image')->hashName();
        $request->file('image')->storeAs('report/images/',$name);
        $detail->image = $name;
        $detail->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        return Redirect::route('reporterreport.show',[$report]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @param  \App\Models\Detailsreport  $detailsreport
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report, Detailsreport $detailsreport)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @param  \App\Models\Detailsreport  $detailsreport
     * @return \Illuminate\Http\Response
     */
    public function edit( $report,  $detailsreport)
    {
        $detail = detailsreport::find($detailsreport);
        return view('reporterdetails.edit',compact('report','detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @param  \App\Models\Detailsreport  $detailsreport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $report, $detailsreport)
    {
        $request->validate([
            'date' => ['required','date'],
            'title' => ['required'],
            'content' => ['required'],
            'image' => ['nullable','image',File::types(['jpg','jpeg','png'])->max(100*1024)],
        ]);
        $detail =  detailsreport::find($detailsreport);
        if($request->file('image') != null)
        {
            Storage::delete('report/images/'.$detail->image);
            $name = $request->file('image')->hashName();
            $request->file('image')->storeAs('report/images/',$name);
            $detail->image = $name;
        }
        $detail->title = trim($request->title);
        $detail->content = trim($request->content);
        $detail->date = $request->date;
        $detail->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        return Redirect::route('reporterreport.show',[$report]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @param  \App\Models\Detailsreport  $detailsreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $report,  $detailsreport)
    {
        $detail = detailsreport::find($request->id);
        Storage::delete('report/images/'.$detail->image);
        $detail->delete();
        toast('موفقانه حذف شد.','success')->width('450px');
        return Redirect::route('reporterreport.show',$report);
    }
}
