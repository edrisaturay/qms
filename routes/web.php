<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $visaTypes = \App\Models\VisaType::where('status', true)->get();
    return view('welcome')->with([
        'visa_types' => $visaTypes,
    ]);
});

Route::prefix('/ajax')
    ->group(function (){
        Route::get('/get-visa_types', function () {
            $visaTypes = \App\Models\VisaType::where('status', true)->get();
            return response()->json($visaTypes);
        })->name('ajax.get_visa_type');
    });
