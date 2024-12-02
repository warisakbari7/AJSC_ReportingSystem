<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportImage;
use App\Models\Report;
use App\Models\ReportSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use ZipArchive;
use Illuminate\Support\Facades\DB;
use App\Models\detailsreport;
class ReporterReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = ReportSchedule::orderBy('end_date','desc')->first();
        $addreport = false;
        if($schedule != null)
        {
            if($schedule->end_date >= now() && $schedule->start_date <= now())
            {
                $addreport = true;
            }
        }
        
        $reports = Report::with(['user','user.zone'])->where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(20);
        return view('reporterreport.index',compact('reports','addreport'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedule =ReportSchedule::orderBy('end_date','desc')->first();
        if($schedule->end_date >= now() && $schedule->start_date <= now())
        return view('reporterreport.create');
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
        $request->validate([
            'title.*' => ['required'],
            'content.*' => ['required'],
            'date.*' => ['required','date'],
            'image.*' => ['nullable',File::types(['jpg','jpeg','png'])->max(100*1024)],
            'video.*' => ['nullable',File::types(['mp4','mov','mkv'])->max(100*1024)],
            'audio.*' => ['nullable',File::types(['wav','mp3'])->max(100*1024)],
            'file.*' => ['nullable',File::types(['rar','zip','pdf'])->max(100*1024)],
            'first' => ['required'],
            'second' => ['required'],
            'third' => ['required'],
            'fourth' => ['required'],
            'fifth' => ['required'],
        ]);
        $video = '';
        $file = '';
        $audio = '';
        if($request->video != '')
        {
            $video = md5(Str::random(30).time().'_'.$request->file('video')).'.'.$request->file('video')->getClientOriginalExtension();
            $request->file('video')->storeAs('/report/videos',$video);
        }
        if($request->audio != '')
        {
            $audio = md5(Str::random(30).time().'_'.$request->file('audio')).'.'.$request->file('audio')->getClientOriginalExtension();
            $request->file('audio')->storeAs('/report/audios',$audio);
        }
        if($request->file('file') != '')
        {
            $file = md5(Str::random(30).time().'_'.$request->file('file')).'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('/report/files',$file);
        }
        DB::beginTransaction();
        $report = new Report(); 
        $report->video = $video;
        $report->audio = $audio;
        $report->file = $file;
        $report->user_id = Auth::user()->id;
        $report->q_first = trim($request->first);
        $report->q_second = trim($request->second);
        $report->q_third = trim($request->third);
        $report->q_fourth = trim($request->fourth);
        $report->q_fifth = trim($request->fifth);
        $report->is_submited = true;
        $report->is_viewed = true;
        $report->save();
        
        for($i = 0; $i < count($request->title); $i++)
        {
            $details = new detailsreport();
            $details->title = trim($request->title[$i]);
            $details->content = trim($request->content[$i]);
            $details->date = trim($request->date[$i]);
            $name = $request->image[$i]->hashName();
            $request->image[$i]->storeAs('/report/images',$name);
            $details->image = $name;  
            $details->report_id = $report->id;    
            $details->save();
        }
        $report->is_submited = true;
        $report->is_viewed = true;
        $report->save();
        DB::commit();

        return response()->json([],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $report = Report::find($id);
        return view('reporterreport.show',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        return view('reporterreport.edit',compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'content' => ['required'],
            'video' => ['nullable',File::types(['mp4','mov','mkv'])->max(100*1024)],
            'audio' => ['nullable',File::types(['wav','mp3'])->max(100*1024)],
            'file' => ['nullable',File::types(['rar','zip','pdf'])->max(100*1024)],
            'first' => ['required'],
            'second' => ['required'],
            'third' => ['required'],
            'fourth' => ['required'],
            'fifth' => ['required'],
        ]);
        $report = Report::find($id);
        
        $video = '';
        $file = '';
        $audio = '';
        if($request->video != '')
        {
            $video = md5(Str::random(30).time().'_'.$request->file('video')).'.'.$request->file('video')->getClientOriginalExtension();
            $request->file('video')->storeAs('/report/videos',$video);
            Storage::delete('report/videos/'.$report->video);
        }
        else
        {
            Storage::delete('report/videos/'.$report->video);
        }
        if($request->audio != '')
        {
            $audio = md5(Str::random(30).time().'_'.$request->file('audio')).'.'.$request->file('audio')->getClientOriginalExtension();
            $request->file('audio')->storeAs('/report/audios',$audio);
            Storage::delete('report/audios/'.$report->audio);

        }
        else
        {
            Storage::delete('report/audios/'.$report->audio);
        }
        if($request->file('file') != '')
        {
            $file = md5(Str::random(30).time().'_'.$request->file('file')).'.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('/report/files',$file);
            Storage::delete('report/files/'.$report->file);
        }
        else
        {
            Storage::delete('report/files/'.$report->file);
        }

        $report->title = trim($request->title);
        $report->content = trim($request->content);
        $report->video = $video;
        $report->audio = $audio;
        $report->file = $file;
        $report->q_first = trim($request->first);
        $report->q_second = trim($request->second);
        $report->q_third = trim($request->third);
        $report->q_fourth = trim($request->fourth);
        $report->q_fifth = trim($request->fifth);
        $report->is_submited = true;
        $report->is_viewed = true;
        $report->save();

        return response()->json(['true'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $report = Report::find($request->id);
        if($report->images != null)
        foreach($report->images as $img)
        {
            Storage::delete('report/images/'.$img->image);
        }
        if($report->video != '')
        Storage::delete('report/videos/'.$report->video);
        if($report->audio != '')
        Storage::delete('report/audios/'.$report->audio);
        if($report->file != '')
        Storage::delete('report/files/'.$report->file);
        $report->images()->delete();
        $report->delete();
        toast('موفقانه حذف شد.','success')->width('450px');
        return Redirect::route('reporterreport.index');
    }

    public function downloadfiles($id)
    {
            $report = Report::find($id);
            $zip_file = "files_of_report(".$report->id.").zip";
            $zip = new ZipArchive();
            $zip->open($zip_file,ZipArchive::CREATE|ZipArchive::OVERWRITE);
            if($report->file != null)
            $zip->addFile(public_path('/storage/report/files/'.$report->file),$report->file);
    
            if($report->audio != null)
            $zip->addFile(public_path('/storage/report/audios/'.$report->audio),$report->audio);
    
            if($report->video != null)
            $zip->addFile(public_path('/storage/report/videos/'.$report->video),$report->video);
            $images = ReportImage::where('report_id',$id)->get();
            if($images->count() > 0)
            {
                foreach($images as $img)
                $zip->addFile(public_path('/storage/report/images/'.$img->image),$img->image);
            }
            if($report->details->count() > 0)
            {
                foreach($report->details as $detail)
                $zip->addFile(public_path('/storage/report/images/'.$detail->image),$detail->image);
            }
            $zip->close();        
            return response()->download($zip_file);

    }



    public function print( $id)
    {
        $report = Report::find($id);
        $data = [
            'reporter' => $report->user->lastname.' '.$report->user->name,
            'printdate' => date_format(now(),'d/m/Y - H:i:s'),
            'zone' => $report->user->zone->name,
            'date' => $report->created_at->format('d/m/Y'),
            'id' => $report->id,
            'title' => $report->title,
            'content' => $report->content,
            'images' => $report->images->toArray(),
            'q_first' => $report->q_first,
            'q_second' => $report->q_second,
            'q_third' => $report->q_third,
            'q_fourth' => $report->q_fourth,
            'q_fifth' => $report->q_fifth,
        ];
        $report = $report->details->toArray();
        return view('reporterreport.print',$data,['report'=>$report]);
    }
    public function search(Request $request) 
    {
        $schedule = ReportSchedule::orderBy('end_date','desc')->first();
        $addreport = false;
        if($schedule != null)
        {
            if($schedule->end_date >= now() && $schedule->start_date <= now())
            {
                $addreport = true;
            }
        }
        $reports= Report::join('users', 'reports.user_id', '=', 'users.id')
        ->join('detailsreports', 'detailsreports.report_id', '=', 'reports.id')
        ->where('title','like','%'.$request->key.'%')
        ->where('reports.user_id','=',Auth::user()->id)
        ->paginate(20);

        return view('reporterreport.search',compact('reports','addreport'));
    }
}
