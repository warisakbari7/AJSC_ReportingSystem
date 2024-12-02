<?php

namespace App\Http\Controllers;

use App\Models\participant;
use App\Models\province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class ParticipantController extends Controller
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
    public function create($report,$meeting)
    {
        $provinces = province::all();
        return view('participant.create',compact('report','meeting','provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$report,$meeting)
    {
        $request->validate([
            'name' => ['required'],
            'position' => ['required'],
            'organization' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'remarks' => ['required'],
            'province' => ['required','exists:provinces,id'],
        ]);
        $participant = new Participant();
        $participant->name = trim($request->name);
        $participant->affiliated_organization = trim($request->organization);
        $participant->position = trim($request->position);
        $participant->province_id = trim($request->province);
        $participant->address = trim($request->address);
        $participant->phone = trim($request->phone);
        $participant->email = trim($request->email);
        $participant->remarks = trim($request->remarks);
        $participant->meeting_id = trim($meeting);
        $participant->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        return Redirect::route('reports.meetings.show',[$report,$meeting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show($report,$meeting,participant $participant)
    {
        return view('participant.show',compact('participant','report','meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit($report,$meeting,participant $participant)
    {
        
        $provinces = province::all();
        return view('participant.edit',compact('participant','meeting','provinces','report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$report,$meeting, participant $participant)
    {
        $request->validate([
            'name' => ['required'],
            'position' => ['required'],
            'organization' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
            'remarks' => ['required'],
            'province' => ['required','exists:provinces,id'],
        ]);

        $participant =  participant::find($participant->id);
        $participant->name = trim($request->name);
        $participant->affiliated_organization = trim($request->organization);
        $participant->position = trim($request->position);
        $participant->province_id = trim($request->province);
        $participant->address = trim($request->address);
        $participant->phone = trim($request->phone);
        $participant->email = trim($request->email);
        $participant->remarks = trim($request->remarks);
        $participant->meeting_id = trim($meeting);
        $participant->save();
        toast('موفقانه ثبت شد.','success')->width('450px');
        return Redirect::route('reports.meetings.participants.show',[$report,$meeting,$participant->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy($report,$meeting,participant $participant)
    {
        $participant->delete();
        toast('موفقانه حذف شد.','success')->width('450px');
        return Redirect::route('reports.meetings.show',[$report,$meeting]);
    }
}
