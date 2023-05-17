<?php

namespace Database\Seeders;

use App\Models\VisaType;
use Illuminate\Database\Seeder;

class VisaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visatypes = [
            'VITEM III' => 'Humanitarian Visa',
            'VITEM XI' => 'Family Reunification Visa',
        ];

        foreach($visatypes as $code => $visatype){
            VisaType::create([
                'name' => $visatype,
                'slug' => \Str::slug($visatype),
                'code' => $code,
                'starting_number' => '001',
                'status' => true,
            ]);
        }
    }
}
