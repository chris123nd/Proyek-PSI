<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\WhatsAppController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/generate-zoom', [Home::class, 'generateZoom']);
Route::post('/generate-zoom-link', [Home::class, 'generateZoomLink']);

Route::get('send-wa', [WhatsAppController::class, 'showForm']);
Route::post('send-wa', [WhatsAppController::class, 'sendMessage'])->name('send-wa');