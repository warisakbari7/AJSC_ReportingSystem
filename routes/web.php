<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DetailsreportController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReporterController;
use App\Http\Controllers\ReportImageController;
use App\Http\Controllers\ReportScheduleController;
use App\Http\Controllers\ReporterReportController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ReporterReportDetailsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',function(){
    return view('index');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('dashboard',function(){
        if(Auth::user()->user_type == 'super_admin' || Auth::user()->user_type == 'admin')
        return redirect()->route('report.index');
        if(Auth::user()->user_type == 'reporter')
        return redirect()->route('reporterreport.index');
    });
    Route::resource('zone',ZoneController::class);
    Route::resource('province',ProvinceController::class);
    Route::resource('super-admin',SuperAdminController::class)->middleware('isa');
    Route::resource('admin',AdminController::class)->middleware('isa');
    Route::post('admin-status',[AdminController::class,'status'])->middleware('isa');
    Route::resource('reporter',ReporterController::class)->middleware('ia');
    Route::get('reporter-search',[ReporterController::class,'search'])->middleware('ia')->name('reporter.search');
    Route::post('reporter-status',[ReporterController::class,'status'])->middleware('ia');
    Route::resource('reportschedule',ReportScheduleController::class)->middleware('ia');
    Route::resource('report',ReportController::class)->middleware('ia');

    Route::get('report/{id}/report-image/create',[ReportImageController::class,'create'])->name('report.image.create');
    Route::post('report/{id}/report-image/',[ReportImageController::class,'store'])->name('report.image.store');
    Route::get('report/{id}/report-image/{img}/edit',[ReportImageController::class,'edit'])->name('report.image.edit');
    Route::put('report/{id}/report-image/{img}/',[ReportImageController::class,'update'])->name('report.image.update');
    Route::get('report/{id}/print',[ReportController::class,'print'])->name('report.print');
    Route::delete('report/{id}/report-image/',[ReportImageController::class,'destroy'])->name('report.image.destroy');
    Route::get('report/{id}/report-files-download/',[ReportController::class,'downloadfiles'])->name('report.file.download');
    Route::post('report/search',[ReportController::class,'search'])->name('report.search');
    Route::resource('reports.details',DetailsreportController::class);
    
    Route::resource('monthlyreport',MonthlyReportController::class)->middleware('ia');
    Route::get('monthlyreport/{id}/print',[MonthlyReportController::class,'print'])->name('monthlyreport.print');
    Route::get('monthlyreport-info',[MonthlyReportController::class,'info'])->name('monthlyreport.info');


    Route::resource('reporterreport',ReporterReportController::class);
    Route::get('reporterreport/{id}/report-files-download/',[ReporterReportController::class,'downloadfiles'])->name('reporterreport.file.download');
    Route::get('reporterreport/{id}/print',[ReporterReportController::class,'print'])->name('reporterreport.print');
    Route::post('reporterreport/search',[ReporterReportController::class,'search'])->name('reporterreport.search');
    Route::resource('reporter-report.detailsreports',ReporterReportDetailsController::class);

    Route::resource('reports.meetings',MeetingController::class);
    Route::resource('reports.meetings.participants',ParticipantController::class);





    Route::get('changepass',[ChangePasswordController::class,'create'])->name('changepass.create');
    Route::put('changepass',[ChangePasswordController::class,'update'])->name('changepass.update');
});











// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });






require __DIR__.'/auth.php';

Auth::routes();

