<?php

namespace App\Http\Controllers;

use App\Models\detailsreport;
use App\Models\Report;
use App\Models\ReportImage;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reports = Report::with(['user','user.zone'])->orderBy('id','desc')->paginate(20);
        return view('report.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth()->user()->user_type == 'super_admin')
        {
        
            $users = User::where('zone_id','!=','null')->get();
            return view('report.create',compact('users'));
        }
        else if(Auth()->user()->user_type == 'admin')
        {
              $users = User::where('zone_id','!=','null')->get();
            return view('report.create',compact('users'));
        }
        else
        return abort(404);
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
            'user' => ['required'],
            'title.*' => ['required'],
            'content.*' => ['required'],
            'date.*' => ['required','date'],
            'r_date' => ['required','date'],
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
            $report->user_id = $request->user;
            $report->created_at = $request->r_date;
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
            DB::commit();
        return response()->json([],200);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {   
        return view('report.show',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        if(Auth::check())
        {
            $users = User::all();
            return view('report.edit',compact('report','users'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        if(Auth::check())
        {
            $request->validate([
                'user' => ['required'],
                'date' => ['required','date'],
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
            $report->user_id = $request->user;
            $report->created_at = $request->date;
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
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
        if($report->details->count() > 0)
        foreach($report->details as $img)
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
        return Redirect::route('report.index');
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
        return view('report.print',$data,['report'=>$report]);
    }
    public function search(Request $request)
    {
        $reports = null;
        switch ($request->search) {
            case '1':
                $reports = Report::join('detailsreports', [['reports.id', 'detailsreports.report_id']])
                    ->where('detailsreports.title','like','%'.$request->key.'%')
                    ->where('reports.is_submited',true)
                    ->orderBy('reports.id', 'DESC')->paginate(20);
                break;
            case '2':
                $reports = Report::join('users','users.id','=','reports.user_id')
                    ->join('zones','zones.id','=','users.zone_id')
                    ->where('zones.name', 'like', '%'.$request->key.'%')->orderBy('id','desc')
                    ->paginate(20,array('reports.id','reports.content','reports.created_at','zones.name'));
                break;
            default:
                $reports = Report::join('users','users.id','=','reports.user_id')
                ->join('zones','zones.id','=','users.zone_id')
                ->where('users.name','like','%'.$request->key.'%')
                ->orWhere('users.lastname','like','%'.$request->key.'%')->orderBy('id','desc')
                ->paginate(20,array('reports.id','reports.content','reports.created_at','zones.name'));
                break;
        }
        return view('report.search',compact('reports'));
    }

}
