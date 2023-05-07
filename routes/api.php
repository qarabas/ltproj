<?php

use App\Http\Controllers\Contact\PhoneController;
use App\Http\Controllers\Contact\EmailController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(ContactController::class)->group(function () {
    Route::get('contact/my-contacts', 'contactList');
    Route::post('contact/search', 'search');
});

Route::controller(PhoneController::class)->group(function () {
    Route::post('contact/phones/delete', 'destroy');
    Route::post('contact/phones/bulk-create', 'bulkCreate');
    Route::post('contact/phones/search', 'search');
});
Route::controller(EmailController::class)->group(function () {
    Route::post('contact/emails/delete', 'destroy');
    Route::post('contact/emails/bulk-create', 'bulkCreate');
    Route::post('contact/emails/search', 'search');
});

