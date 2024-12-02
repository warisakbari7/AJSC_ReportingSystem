<?php

namespace App\Http\Controllers;

use App\Models\ReportSchedule;
use App\Models\Report;
use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
class ReportScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weeks = ReportSchedule::orderBy('end_date','desc')->paginate(15);
        $enddate =ReportSchedule::max('end_date');
        return view('reportschedule.index',compact('weeks','enddate'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $request->validate([
            'start_date' => ['required','date','after_or_equal:'.$today],
            'end_date' => ['required','date','after:start_date']
        ]);
        $lastdeadline = ReportSchedule::max('end_date');
        if($lastdeadline > $request->start_date)
        {
            return back()->with(['err'=>'true']);
        }
        else
        {
            $report = new ReportSchedule();
            $report->start_date = $request->start_date;
            $report->end_date = $request->end_date;
            $report->save();
            toast('موفقانه ثبت شد.','success')->width('450px');
            return Redirect::route('reportschedule.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReportSchedule  $reportSchedule
     * @return \Illuminate\Http\Response
     */
    public function show( $weekid)
    {
        $schedule = ReportSchedule::find($weekid);
        $weeklyreports = WeeklyReport::where('reportSchedule_id',$weekid)->paginate(20);
        $dailyreports = Report::where('created_at','<',$schedule->end_date)
        ->where('created_at','>',$schedule->start_date)->paginate(20);
        $dailyreports->setPageName('page_r');
        return view('reportschedule.show',compact('dailyreports','weeklyreports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportSchedule  $reportSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportSchedule $reportSchedule ,$id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportSchedule  $reportSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportSchedule  $reportSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $date = ReportSchedule::find($id);
        $date->delete();
        toast('موفقانه حذف شد.','success')->width('450px');
        return Redirect::route('reportschedule.index');
    }
}
