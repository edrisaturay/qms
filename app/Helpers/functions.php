<?php


if (!function_exists('get_last_queue_item')){
    function get_next_queue_item(\App\Models\VisaType $_visa_type){
        return \App\Models\Queue::where('visa_type_id', $_visa_type->id)
            ->where('status', \App\Models\Queue::$PENDING)
            ->orderBy('created_at', 'asc')
            ->first();
    }
}


