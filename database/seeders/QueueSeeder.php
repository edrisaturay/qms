<?php

namespace Database\Seeders;

use App\Models\Counter;
use App\Models\Queue;
use App\Models\VisaType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class QueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<100; $i++){
            $visaType = VisaType::all()->random(1)->first();
            $counter = Counter::all()->random(1)->first();

            if ($visaType) {
                Queue::create([
                    'status' => Queue::$_QUEUE_STATUS_LINEUP,
                    'number' => get_next_queue_number($visaType),
                    'counter_id' => $counter->id,
                    'visa_type_id' => $visaType->id,
                ]);
            }
        }
    }
}
