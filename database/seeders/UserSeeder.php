<?php

namespace Database\Seeders;

use App\Models\Counter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin User',
            'email' => 'eturay@iom.int',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('Admin1234'),
        ]);
        $superAdmin->assignRole('super admin');

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@iom.int',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('Admin1234'),
        ]);
        $admin->assignRole('admin');

        for($i = 1; $i <= 10; $i++){
            $agent = User::create([
                'name' => 'CAVB Agent User' . $i,
                'email' => 'agent'.$i.'@iom.int',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => \Hash::make('Admin1234'),
            ]);
            $agent->assignRole('agent');

            $counter = $agent->counter()->create([
                'name' => 'Counter ' . $i,
                'slug' => Str::slug('Counter ' . $i),
                'status' => true,
            ]);

            $counter->visaTypes()->attach(rand(1,2));
        }
    }
}
