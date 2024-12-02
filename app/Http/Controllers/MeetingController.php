<?php

namespace App\Http\Controllers;

use App\Models\meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\province;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function create($report)
     {
         $provinces = province::all();
         return view('meeting.create',compact('provinces','report'));
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
            'name' => ['required'],
            'position' => ['required'],
            'organization' => ['required'],
            'address' => ['required'],
            'start' => ['required','date'],
            'end' => ['required','after:start'],
            'outcome' => ['required'],
            'mainpoints' => ['required'],
            'province' => ['required','exists:provinces,id'],
        ]);
        $ma = new meeting();
        $ma->trainer = trim($request->name);
        $ma->position = trim($request->position);
        $ma->affiliated_organization = trim($request->organization);
        $ma->talkingpoints = trim($request->mainpoints);
        $ma->start_time = trim($request->start);
        $ma->end_time = trim($request->end);
        $ma->province_id = trim($request->province);
        $ma->address = trim($request->address);
        $ma->outcome = trim($request->outcome);
        $ma->report_id = $report;
        $ma->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        if(Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin')
            return Redirect::route('report.show',$report);
        else
            return Redirect::route('reporterreport.show',$report);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show($report,meeting $meeting)
    {
        return view('meeting.show',compact('report','meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit($report,meeting $meeting)
    {
        $provinces = province::all();
        return view('meeting.edit',compact('report','meeting','provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $report, meeting $meeting)
    {
        $request->validate([
            'name' => ['required'],
            'position' => ['required'],
            'organization' => ['required'],
            'address' => ['required'],
            'start' => ['required','date'],
            'end' => ['required','after:start'],
            'outcome' => ['required'],
            'mainpoints' => ['required'],
            'province' => ['required','exists:provinces,id'],
        ]);
        $meeting = meeting::find($meeting->id);
        $meeting->trainer = trim($request->name);
        $meeting->position = trim($request->position);
        $meeting->affiliated_organization = trim($request->organization);
        $meeting->talkingpoints = trim($request->mainpoints);
        $meeting->start_time = trim($request->start);
        $meeting->end_time = trim($request->end);
        $meeting->province_id = trim($request->province);
        $meeting->address = trim($request->address);
        $meeting->outcome = trim($request->outcome);
        $meeting->report_id = $report;
        $meeting->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        return Redirect::route('reports.meetings.show',[$report,$meeting->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy($report,meeting $meeting)
    {
        $meeting->delete();
        toast('موفقانه حذف شد.','success')->width('450px');
        if(Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin')
            return Redirect::route('report.show',$report);
        else
            return Redirect::route('reporterreport.show',$report);
    }
}
