<?php


if (!function_exists('get_last_queue_item')){
    function get_next_queue_item(\App\Models\VisaType $_visa_type){
        return \App\Models\Queue::where('visa_type_id', $_visa_type->id)
            ->where('status', \App\Models\Queue::$PENDING)
            ->orderBy('created_at', 'asc')
            ->first();
    }
}

if (!function_exists('get_setting')){
    function get_setting($_setting_name){
        return \Backpack\Settings\app\Models\Setting::get($_setting_name);
    }
}

if (!function_exists('get_queue_statuses')) {
    function get_queue_statuses() {
        return \App\Models\Queue::$queueStatuses;
    }
}

// Get next queue number
if (!function_exists('get_next_queue_number')){
    function get_next_queue_number( \App\Models\VisaType $_visa_type): int
    {
        $lastInQueueForVisaType = \App\Models\Queue::where('visa_type_id', $_visa_type->id)
            ->latest('id')
            ->first();
        if ($lastInQueueForVisaType){
            return ((int) $lastInQueueForVisaType->number + 1);
        }
        return 1;
    }
}

if (!function_exists('get_visa_type_code')) {
    function get_visa_type_code($_visa_type_id) {
        return \App\Models\VisaType::find($_visa_type_id)->code;
    }
}

if (!function_exists('get_today_vitem_iii_queue')){
    function get_today_vitem_iii_queue(){
        return \App\Models\Queue::where('created_at', '>=', \Carbon\Carbon::today())
            ->where('visa_type_id', \App\Models\VisaType::$HUMANITARIAN)
            ->get()->count();
    }
}

if (!function_exists('get_today_vitem_xi_queue')){
    function get_today_vitem_xi_queue(){
        return \App\Models\Queue::where('created_at', '>=', \Carbon\Carbon::today())
            ->where('visa_type_id', \App\Models\VisaType::$FAMILY_REUNIFICATION)
            ->get()->count();
    }
}

if (!function_exists('get_today_completed_queue')){
    function get_today_completed_queue(){
        return \App\Models\Queue::where('created_at', '>=', \Carbon\Carbon::today())
            ->where('status', \App\Models\Queue::$_QUEUE_STATUS_SERVED)
            ->get()->count();
    }
}

if (!function_exists('get_today_pending_queue')){
    function get_today_pending_queue(){
        return \App\Models\Queue::where('created_at', '>=', \Carbon\Carbon::today())
            ->where('status', \App\Models\Queue::$_QUEUE_STATUS_LINEUP)
            ->get()->count();
    }
}

if (!function_exists('get_today_total_queue')){
    function get_today_total_queue(){
        return \App\Models\Queue::where('created_at', '>=', \Carbon\Carbon::today())
            ->get()->count();
    }
}

if (!function_exists('get_percentage')){
    function get_percentage($_numerator, $_denominator){
        if ($_denominator == 0){
            return 0;
        }
        return round(($_numerator / $_denominator) * 100, 2);
    }
}

