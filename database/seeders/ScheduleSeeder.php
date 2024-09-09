<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert([
            'employee_id' => 1, // Test Employee
            'mo_start' => '09:00:00',
            'mo_end' => '17:00:00',
            'tu_start' => '09:00:00',
            'tu_end' => '17:00:00',
            'we_start' => '09:00:00',
            'we_end' => '17:00:00',
            'th_start' => '09:00:00',
            'th_end' => '17:00:00',
            'fr_start' => '09:00:00',
            'fr_end' => '17:00:00',
            'sa_start' => null,
            'sa_end' => null,
            'su_start' => null,
            'su_end' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
