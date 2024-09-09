<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
            'phone' => '0612345678',
            'role_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('accounts')->insert([
            'name' => 'Test Customer',
            'email' => 'customer1@email.com',
            'password' => Hash::make('password'),
            'phone' => '0612345678',
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('accounts')->insert([
            'name' => 'Test Customer 2',
            'email' => 'customer2@email.com',
            'password' => Hash::make('password'),
            'phone' => '0612345678',
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('accounts')->insert([
            'name' => 'Test Employee',
            'email' => 'employee1@email.com',
            'password' => Hash::make('password'),
            'phone' => '0612345678',
            'role_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('accounts')->insert([
            'name' => 'Test Employee 2',
            'email' => 'employee2@email.com',
            'password' => Hash::make('password'),
            'phone' => '0612345678',
            'role_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

      
    }
}
