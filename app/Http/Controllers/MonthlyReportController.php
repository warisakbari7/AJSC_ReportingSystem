<?php

namespace App\Http\Controllers;

use App\Models\ReportSchedule;
use App\Models\User;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
class MonthlyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = MonthlyReport::orderBy('id','desc')->paginate(20);
        return view('monthlyreports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reporters = User::where('user_type','reporter')->get();
        return view('monthlyreports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'date' => 'required',

        ]);
        $report = new MonthlyReport();
        $report->content = trim($request->content);
        $report->user_id = Auth::user()->id;
        $report->date = $request->date;
        $report->save();
        toast('موفقانه ثیت شد.','success')->width('450px');
        return Redirect::route('monthlyreport.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthlyReport  $monthlyReport
     * @return \Illuminate\Http\Response
     */
    public function show($report)
    {
        $report = MonthlyReport::find($report);
        return view('monthlyreports.show',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MonthlyReport  $monthlyReport
     * @return \Illuminate\Http\Response
     */
    public function edit($report)
    {
        $report = MonthlyReport::find($report);
        return view('monthlyreports.edit',compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthlyReport  $monthlyReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $report)
    {
        $report = MonthlyReport::find($report);
        $request->validate([
            'content' => 'required',
            'date' => 'required',
        ]);
        $report->content = trim($request->content);
        $report->date = $request->date;
        $report->save();
        toast('موفقانه ثیت شد.','success')->width('450px');
        return Redirect::route('monthlyreport.show',$report->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyReport  $monthlyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $report = MonthlyReport::find($request->id);
        $report->delete();
        toast('موفقانه حذف شد.','success')->width('450px');
        return Redirect::route('monthlyreport.index');
    }
    

    public function print($id)
    {
        $report = MonthlyReport::find($id);
        return view('monthlyreports.print',compact('report'));
    }

    public function info()
    {

        return view('monthlyreports.info');
    }
}
