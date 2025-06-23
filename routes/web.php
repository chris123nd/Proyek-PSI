<?php

use App\Exports\FullDataExport;
use App\Http\Controllers\AdminController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Home;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix' => 'account'], function(){
    //guest middleware
   Route::group(['middleware' => 'guest'], function(){
    Route::get('login',[LoginController::class,'showLoginForm'])->name('account.login');
    Route::get('register',[LoginController::class,'register'])->name('account.register');
    Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
    Route::post('authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');

   });
   
   // Authenticated middleware
   Route::group(['middleware' => 'auth'], function(){
    Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
    Route::get('dashboard',[DashboardController::class,'index'])->name('account.dashboard');

   });
});

Route::resource('/tickets', \App\Http\Controllers\TicketController::class);
// Route::get('meet', [Home::class, 'test'])->name('meet');

Route::post('meet', [Home::class, 'createMeeting'])->name('meet');
Route::get('meet', function () {
    return view('zoom.create'); // View untuk form
})->name('meet.form');

Route::post('meet', [Home::class, 'createMeeting'])->name('meet');

// Route::get('send-wa', function(){
//     $response = Http::withHeaders([
//         'Authorization' => 'sJKyRptUdnqLVpKCHHvF',
//     ])->post('https://api.fonnte.com/send' , [
//         'target' => '6285362025601',
//         'message' => 'Hello from Fonnte API',
//     ]);
//     dd(json_decode($response, true));
// });

Route::get('send-wa', [WhatsAppController::class, 'showForm']);
Route::post('send-wa', [WhatsAppController::class, 'sendMessage'])->name('send-wa');

Route::post('/generate-zoom', [App\Http\Controllers\Home::class, 'generateZoom'])->name('zoom.generate');
Route::post('/generate-zoom-link', [Home::class, 'generateZoomLink'])->name('generate.zoom.link');

// Route::get('/surveys', [SurveyController::class, 'index'])->name('surveys.index');

// UMKM routes
Route::resource('umkms', UmkmController::class);
Route::get('umkms/status/{id}/{status}', [UmkmController::class, 'updateStatus'])->name('umkms.updateStatus');
Route::resource('umkms', UmkmController::class);

// Nested: Layanan routes under UMKM
Route::prefix('umkms/{umkm}')->group(function () {
    Route::get('layanans/create', [LayananController::class, 'create'])->name('umkms.layanans.create');
    Route::post('layanans', [LayananController::class, 'store'])->name('umkms.layanans.store');

    // Nested: Survey routes under UMKM & Layanan
    Route::get('layanans/{layanan}/surveys/create', [SurveyController::class, 'create'])->name('umkms.layanans.surveys.create');
});

// Global index & CRUD
Route::resource('layanans', LayananController::class)->except(['create', 'store']);
Route::resource('surveys', SurveyController::class)->except(['create']);
// Route::get('/report/rekap', [LaporanController::class, 'rekap'])->name('report.rekap');
Route::get('/chart-layanan', [App\Http\Controllers\DashboardController::class, 'chart'])->name('chart.layanan');
Route::put('/surveys/{survey}/submit', [SurveyController::class, 'submit'])->name('surveys.submit');


Route::get('/export/full', function () {
    return Excel::download(new FullDataExport, 'data_umkm_layanan_survey.xlsx');
})->name('export.full');


Route::middleware('auth')->group(function () {
    Route::get('/change-password', [LoginController::class, 'showChangePasswordForm'])->name('account.change-password.form');
    Route::post('/change-password', [LoginController::class, 'changePassword'])->name('account.change-password');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/create-petugas', [AdminController::class, 'createPetugas'])->name('admin.create.petugas');
    Route::post('/admin/store-petugas', [AdminController::class, 'storePetugas'])->name('admin.store.petugas');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/account/create-petugas', [AdminController::class, 'createPetugas'])->name('account.create-petugas');
    Route::post('/account/store-petugas', [AdminController::class, 'storePetugas'])->name('account.store-petugas');
});












