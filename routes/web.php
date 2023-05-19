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

        Route::post('/lineup-entry', function (){
            $request = request();
            $visaType = \App\Models\VisaType::find($request->input('visa_type_id'));
            $queueNumber = get_next_queue_number($visaType);
            $queue = new \App\Models\Queue();
            $queue->number = $queueNumber;
            $queue->visa_type_id = $visaType->id;
            $queue->status = \App\Models\Queue::$_QUEUE_STATUS_LINEUP;
            $queue->save();
            return response()->json($queue);
        })->name('ajax.lineup_entry');

        Route::get('/call-next', function () {
             // Get the current user along with the counter and visa type
            $counter = \App\Models\Counter::with('visa_types')
                ->where('user_id', backpack_user()->id)
                ->first();
            if (!$counter){
                return response()->json([
                    'status' => false,
                    'message' => 'Counter not found',
                ]);
            } else {
                // Get the next queue number for the visa type
                $nextQueue = \App\Models\Queue::where('status', \App\Models\Queue::$_QUEUE_STATUS_LINEUP)
                    ->whereIn('visa_type_id',
                        $counter->visa_types->pluck('id')->toArray())
                    ->oldest('id')
                    ->first();
                if (!$nextQueue){
                    return response()->json([
                        'status' => false,
                        'message' => 'You are not assigned to a visa type or there are no queues to call'
                    ]);
                } else {
                    // get the previous queue for the current counter

                    // Update the queue and counter status to calling
                    $nextQueue->status = \App\Models\Queue::$_QUEUE_STATUS_CALLING;
                    $nextQueue->counter_id = $counter->id;
                    $nextQueue->save();
                    $visaType = \App\Models\VisaType::find($nextQueue->visa_type_id);
                    $counter->status = \App\Models\Counter::$COUNTER_STATUS_CALLING;
                    $counter->save();

                    return response()->json([
                        'status' => true,
                        'message' => $visaType->code . ' - ' . $nextQueue->number . ' is on the way to you.',
                        'queue' => $nextQueue,
                    ]);
                }
            }
        })->name('ajax.call_next');
        Route::get('/recall-last', function () {
            // Get the current user counter
            $counter = \App\Models\Counter::with('visa_types')
                ->where('user_id', backpack_user()->id)
                ->first();
            if (!$counter){
                return response()->json([
                    'status' => false,
                    'message' => 'Counter not found',
                ]);
            }else{
                // Get the last queue number for the counter
                $lastQueue = \App\Models\Queue::whereIn('status', [
                    \App\Models\Queue::$_QUEUE_STATUS_CALLING,
                    \App\Models\Queue::$_QUEUE_STATUS_RECALL,
                ])
                    ->where('counter_id', $counter->id)
                    ->latest('id')
                    ->first();
                if (!$lastQueue){
                    return response()->json([
                        'status' => false,
                        'message' => 'You are not assigned to a visa type or there are no queues to recall'
                    ]);
                }else{
                    // Recall the last queue and set the counter status to calling
                    $lastQueue->status = \App\Models\Queue::$_QUEUE_STATUS_RECALL;
                    $lastQueue->save();
                    $visaType = \App\Models\VisaType::find($lastQueue->visa_type_id);
                    $counter->status = \App\Models\Counter::$COUNTER_STATUS_CALLING;
                    $counter->save();
                    return response()->json([
                        'status' => true,
                        'message' => $visaType->code . ' - ' . $lastQueue->number . ' is on the way to you.',
                        'queue' => $lastQueue,
                    ]);
                }
            }
        })->name('ajax.recall_last');
        Route::get('/complete-current', function () {

        })->name('ajax.complete_current');
    });
